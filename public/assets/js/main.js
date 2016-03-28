/**
 * Created by stephen.parker on 13/03/2016.
 */

var React = require('react');
var ReactDom = require('react-dom');
var marked = require('marked');
var $ = jQuery = require('jquery');
var moment = require('moment');
var ReactCSSTransitionGroup = require('react-addons-css-transition-group');
//var bootstrap = require('bootstrap');

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

var WeatherTop = React.createClass({
    iconTable: {
        '01d': 'wi-day-sunny',
        '02d': 'wi-day-cloudy',
        '03d': 'wi-cloudy',
        '04d': 'wi-cloudy-windy',
        '09d': 'wi-showers',
        '10d': 'wi-rain',
        '11d': 'wi-thunderstorm',
        '13d': 'wi-snow',
        '50d': 'wi-fog',
        '01n': 'wi-night-clear',
        '02n': 'wi-night-cloudy',
        '03n': 'wi-night-cloudy',
        '04n': 'wi-night-cloudy',
        '09n': 'wi-night-showers',
        '10n': 'wi-night-rain',
        '11n': 'wi-night-thunderstorm',
        '13n': 'wi-night-snow',
        '50n': 'wi-night-alt-cloudy-windy'
    },
    getInitialState: function () {
        return this.props;
    },
    componentWillReceiveProps: function (incoming) {
        console.log(incoming);
        this.setState(incoming);
    },
    render: function () {
        if (this.props.hasOwnProperty('weather')) {
            var srt = this.props.weather.weather.city.sunrise;
            var sst = this.props.weather.weather.city.sunset;
            var windMs = this.props.weather.weather.weatherItem.wind.speedValue;
            var windMph = (windMs * 2.23694).toFixed(1);
            var currentWeather = this.props.weather.weather.weatherItem;
            var windDirection = currentWeather.wind.directionValue;

            var now = moment().format('HH:mm');
            var sunRiseTime = moment.unix(srt).format('HH:mm');
            var sunSetTime = moment.unix(sst).format('HH:mm');

            var sunPlace = (
                <span><span className="wi wi-sunrise xdimmed"></span>{sunRiseTime}</span>
            );

            if (sunRiseTime < now && sunSetTime > now) {
                sunPlace = (
                    <span><span className="wi wi-sunset xdimmed"></span>{sunSetTime}</span>
                );
            }

            var windSun = (
                <span className="windSun small dimmed">
                    <span className="wind">
                        <span className={"wi wi-wind from-" + windDirection + "-deg xdimmed"}></span>{windMph}
                    </span>
                    <span className="sun">
                        {sunPlace}
                    </span>
                </span>
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

var WeatherForecast = React.createClass({
    render: function () {
        return (
            <div id="weatherForecast"></div>
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
        return {};
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
