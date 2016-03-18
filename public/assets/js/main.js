/**
 * Created by stephen.parker on 13/03/2016.
 */

var React = require('react');
var ReactDom = require('react-dom');
var marked = require('marked');
var $ = jQuery = require('jquery');
var moment = require('moment');
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
    mixins: [SetIntervalMixin],
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
        this.setInterval(this.loadLayoutFromServer, 5000);
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
        var inlineStyle = {
            top: this.props.position.y,
            left: this.props.position.x
        };

        var component;

        switch (this.props.name) {
            case 'clock':
                component = (<ComponentClock {...this.props} />);
                break;

            case 'compliment':
                component = (<ComponentCompliment {...this.props} />);
                break;
        }

        return (
            <div className="componentContainerModule" style={inlineStyle}>
                {component}
            </div>
        );
    }
});

var ComponentClock = React.createClass({
    mixins: [SetIntervalMixin],
    handleUpdate: function () {

    },
    getInitialState: function () {
        return {
            date: moment().format('dddd, D MMMM YYYY'),
            time: moment().format('HH:mm')
        };
    },
    tick: function () {
        this.setState({
            date: moment().format('dddd, D MMMM YYYY'),
            time: moment().format('HH:mm')
        });
    },
    componentDidMount: function () {
        this.setInterval(this.tick, 1000);
    },
    render: function () {
        return (
            <div className="componentClock">
                <span className="date dim">{this.state.date}</span>
                <span className="time">{this.state.time}</span>
            </div>
        );
    }
});

var ComponentCompliment = React.createClass({
    render: function () {
        return (
            <div className="componentCompliment">
                {this.props.text}
            </div>
        );
    }
});


ReactDom.render(
    <SmContainer url="/api/layout" />,
    document.getElementById('content')
);
