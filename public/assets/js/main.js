/**
 * Created by stephen.parker on 13/03/2016.
 */

var React = require('react');
var ReactDom = require('react-dom');
var $ = jQuery = require('jquery');
var moment = require('moment');
var ReactCSSTransitionGroup = require('react-addons-css-transition-group');

// SetInterval mixin, allowing timed events to occur
var SetIntervalMixin = {
    componentWillMount: function() {
        this.intervals = [];
    },
    setInterval: function() {
        this.intervals.push(setInterval.apply(null, arguments));
    },
    componentWillUnmount: function() {
        this.intervals.forEach(clearInterval);
    }
};

// This will be the components that controls whats shown
var SmContainer = React.createClass({
    loadLayoutFromServer: function () {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            cache: false,
            success: function (data) {
                this.setState({data: data});
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    getInitialState: function () {
        return {data: {
            modules: []
        }};
    },
    componentDidMount: function () {
        this.loadLayoutFromServer();
    },
    render: function () {
        var elements = this.state.data.modules.map(function (element) {
            return (
                <SmComponentContainer
                    key={element.id}
                    {...element}
                >
                </SmComponentContainer>
            );
        });
        return (
            <div className="componentContainer">
                {elements}
            </div>
        );
    }
});

var SmComponentContainer = React.createClass({
    render: function () {
        var component;

        switch (this.props.name) {
            case 'clock':
                component = (<ComponentClock {...this.props} />);
                break;

            case 'compliment':
                component = (<ComponentCompliment {...this.props} />);
                break;

            case 'weather':
                component = (<ComponentWeather {...this.props} />);
                break;
        }

        return (
            <div className="componentContainerModule" id={"component" + this.props.name}>
                <div className="componentContainer">
                    {component}
                </div>
            </div>
        );
    }
});

var ClockDate = React.createClass({
    rawMarkup: function () {
        //var rawMarkup = this.state.value.format('[<span class="dayname">]dddd,[</span> <span class="longdate">]MMMM Do[</span>]');
        var rawMarkup = this.state.value.format('[<span class="dayname">]dddd,[</span> <span class="longdate">]MMMM Do[</span>]');
        return {__html: rawMarkup};
    },
    getInitialState: function () {
        return {
            value: this.props.value
        };
    },
    componentWillReceiveProps: function (incoming) {
        this.setState(incoming);
    },
    render: function () {
        return (
            <ReactCSSTransitionGroup transitionName="fade" transitionAppear={true} transitionAppearTimeout={500}
                                     transitionEnterTimeout={1000} transitionLeaveTimeout={1000}>
                <span className="dimmed small" key={this.state.value.format('YYYYMMDD')}
                      dangerouslySetInnerHTML={this.rawMarkup()}/>
            </ReactCSSTransitionGroup>
        );
    }
});

var ClockTime = React.createClass({
    getInitialState: function () {
        return {
            value: this.props.value
        };
    },
    componentWillReceiveProps: function (incoming) {
        this.setState(incoming);
    },
    render: function () {
        return (
            <ReactCSSTransitionGroup transitionName="fade" transitionAppear={true} transitionAppearTimeout={500}
                                     transitionEnterTimeout={1000} transitionLeaveTimeout={1000}>
                <span key={this.state.value.format('HH:mm')}>
                    {this.state.value.format('HH:mm')}
                </span>
            </ReactCSSTransitionGroup>
        );
    }
});

var ComponentClock = React.createClass({
    mixins: [SetIntervalMixin],
    handleUpdate: function () {

    },
    getInitialState: function () {
        return {
            dateTime: moment()
        };
    },
    tick: function () {
        this.setState({
            dateTime: moment()
        });
    },
    componentDidMount: function () {
        this.setInterval(this.tick, this.props.provider.updateRate);
    },
    render: function () {
        // In order to animate in place, change the key, and make the element absolute
        return (
            <span>
                <div className="date">
                    <ClockDate value={this.state.dateTime}/>
                </div>
                <div className="time">
                    <ClockTime value={this.state.dateTime}/>
                </div>
            </span>
        );
    }
});

var ComponentCompliment = React.createClass({
    mixins: [SetIntervalMixin],
    componentDidMount: function () {
        this.loadFromServer();
        this.setInterval(this.loadFromServer, this.props.provider.updateRate);
    },
    getInitialState: function () {
        return {
            data: {
                text: 'Mirror, mirror on the wall'
            }
        }
    },
    loadFromServer: function () {
        $.ajax({
            url: this.props.provider.url,
            dataType: 'json',
            cache: false,
            success: function (data) {
                this.setState({data: { text: data.compliment.text }});
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.provider.url, status, err.toString());
            }.bind(this)
        });
    },
    render: function () {
        return (
            <ReactCSSTransitionGroup transitionName="fade" transitionAppear={true} transitionAppearTimeout={500} transitionEnterTimeout={1000} transitionLeaveTimeout={1000}>
                <div className="compliment" key={this.state.data.text}>
                    {this.state.data.text}
                </div>
            </ReactCSSTransitionGroup>
        );
    }
});

var WeatherToday = React.createClass({
	propTypes: {
		id: React.PropTypes.number,
		temperature: React.PropTypes.number,
		units: React.PropTypes.string,
		sunriseTime: React.PropTypes.string,
		sunsetTime: React.PropTypes.string,
		now: React.PropTypes.string
	},
	isDay: function () {
		if (this.props.sunriseTime < this.props.now && this.props.sunsetTime > this.props.now) {
			return true;
		} else {
			retunr false;
		}
	},
	getIconClass: function () {
		return 'wi-owm-' + (this.isDay() ? 'day' : 'night') + '-' + this.props.id;
	}
	render: function () {
		return (
            <span className="today">
  	          	<span className={"icon " + this.getIconClass() + " dimmed wi"}></span>
				<span>{this.props.temperature.toFixed(0)}&deg;{this.props.units}</span>
            </span>
		);
	}
});

var WeatherWind = React.createClass({
	propTypes: {
		direction: React.PropTypes.string,
		speed: React.PropTypes.number
	},
	render: function () {
		return (
			<span className="wind">
				<span className={"wi wi-wind from-" + this.props.direction + "-deg xdimmed"}></span>{this.props.speed.toFixed(1)}
			</span>
		);		
	}
});

var WeatherSunState = React.createClass({
	propTypes: {
		sunriseTime: React.PropTypes.string,
		sunsetTime: React.PropTypes.string,
		now: React.PropTypes.string,
	},
	render: function () {
		var sun = (
			<span><span className="wi wi-sunrise xdimmed"></span>{this.props.sunriseTime}</span>
		);

		if (this.props.sunriseTime < this.props.now && this.props.sunsetTime > this.props.now) {
			sun = (
				<span><span className="wi wi-sunset xdimmed"></span>{this.props.sunsetTime}</span>
			);
		}
		
		return (
			<span className="sun">{sun}</span>
		);
	}
});

var WeatherTop = React.createClass({
    componentWillReceiveProps: function (incoming) {
    	console.log('componentWillReceiveProps');
        console.log(incoming);
    },
    render: function () {
        if (this.props.hasOwnProperty('weather')) {
            var windMph = (this.props.weather.weather.weatherItem.wind.speedValue * 2.23694),
    			currentWeather = this.props.weather.weather.weatherItem,
    			sunriseTime = moment.unix(this.props.weather.weather.city.sunrise).format('HH:mm'),
    			sunsetTime = moment.unix(this.props.weather.weather.city.sunset).format('HH:mm'),
    			now = moment().format('HH:mm');

            var windSun = (
                <span className="windSun small dimmed">
                	<WeatherWind direction={currentWeather.wind.directionValue} speed={windMph} />
                    <WeatherSunState sunriseTime={sunriseTime} sunsetTime={sunsetTime} now={now} />
                </span>
            );

            var todayWeather = (
            	<WeatherToday id={currentWeather.number} temperature={currentWeather.temperature.value} units={currentWeather.temperature.units} sunriseTime={sunriseTime} sunsetTime={sunsetTime} now={now} />
        	);

            var todayWeather = (
                <span className="today">
                    <span className={"icon " + this.iconTable[currentWeather.icon] + " dimmed wi"}></span>
                    <span>{currentWeather.temperature.value.toFixed(0)}&deg;{currentWeather.temperature.units}</span>
                </span>
            );

            return (
                <div id="weatherTop">
                    {windSun}
                    {todayWeather}
                </div>
            );
        } else {
            return (
                <div id="weatherTop">
                </div>
            );
        }
    }
});

var WeatherForecastRow = React.createClass({
	render: function () {	
		var day = moment.unit(this.props.timestamp).format('ddd');
		var windMph = (this.props.weather.weather.weatherItem.wind.speedValue * 2.23694);
		var windIcon = (
			<WeatherWind direction={this.props.wind.directionValue} speed={windMph} />)
		;

		return (
			<span>{windIcon} {day}: {this.props.temperature.value} {this.props.temperature.min} {this.props.temperature.max}</span>
		);
	}
})

var WeatherForecast = React.createClass({
    render: function () {

		var weatherRows = this.props.forecast.map(function (comment) {
            return (
            	<WeatherForecastRow ...{this.props} />
            )
        }).bind(this);
        
        return (
            <div id="weatherForecast">{weatherRows}</div>
        )
    }
});

var ComponentWeather = React.createClass({
    mixins: [SetIntervalMixin],
    componentDidMount: function () {
        this.loadFromServer();
        this.setInterval(this.loadFromServer, this.props.provider.updateRate);
    },
    getInitialState: function () {
        return { data: null };
    },
    loadFromServer: function () {
        $.ajax({
            url: this.props.provider.url,
            dataType: 'json',
            cache: false,
            success: function (data) {
                this.setState(data);
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.provider.url, status, err.toString());
            }.bind(this)
        });
    },
    render: function () {
        var weatherPanel = (
            <div className="weatherPanel">
                <div className="weatherTop">
                    <WeatherTop {...this.state} />
                </div>
                <div className="weatherForecast">
                    <WeatherForecast {...this.state} />
                </div>
            </div>
        );

        return (
            <ReactCSSTransitionGroup transitionName="fade" transitionAppear={true} transitionAppearTimeout={500} transitionEnterTimeout={1000} transitionLeaveTimeout={1000}>
                <div className="weather">
                    {weatherPanel}
                </div>
            </ReactCSSTransitionGroup>
        );
    }
});


ReactDom.render(
    <SmContainer url="/api/layout" />,
    document.getElementById('content')
);
