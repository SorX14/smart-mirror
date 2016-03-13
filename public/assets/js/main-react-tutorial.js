/**
 * Created by stephen.parker on 12/03/2016.
 */

var React = require('react');
var ReactDom = require('react-dom');
var marked = require('marked');
var $ = require('jquery');

var data = [
    {id: 1, author: "Pete Hunt", text: "This is one comment"},
    {id: 2, author: "Jordan Walke", text: "This is *another* comment"}
];

var Comment = React.createClass({
    rawMarkup: function () {
        var rawMarkup = marked(this.props.children.toString(), {sanitize: true});
        return {__html: rawMarkup};
    },

    handleDelete: function () {
        this.props.onCommentDelete({id: this.props.id});
    },

    render: function () {
        return (
            <div className="comment">
                <h2 className="commentAuthor">
                    {this.props.author}
                </h2>
                <span dangerouslySetInnerHTML={this.rawMarkup()}/>
                <button onClick={this.handleDelete} className="btn btn-xs btn-danger">Delete</button>
            </div>
        )
    }
});

var CommentBox = React.createClass({
    loadCommentsFromServer: function () {
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
    handleClear: function () {
        this.setState({data: []});

        $.ajax({
            url: this.props.clearUrl,
            dataType: 'json',
            cache: false,
            success: function (data) {
                this.setState({data: data});
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.clearUrl, status, err.toString());
            }.bind(this)
        });
    },
    handleCommentDelete: function (comment) {
        $.ajax({
            url: this.props.clearUrl + '/' + comment.id,
            dataType: 'json',
            cache: false,
            success: function (data) {
                this.setState({data: data});
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.clearUrl, status, err.toString());
            }.bind(this)
        });
    },
    handleCommentSubmit: function (comment) {
        var comments = this.state.data;

        comment.id = Date.now();
        var newComments = comments.concat([comment]);
        this.setState({data: newComments});

        $.ajax({
            url: this.props.url,
            dataType: 'json',
            type: 'POST',
            data: comment,
            success: function (data) {
                this.setState({data: data});
            }.bind(this),
            error: function (xhr, status, err) {
                this.setState({date: comments});
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    getInitialState: function () {
        return {data: []};
    },
    componentDidMount: function () {
        this.loadCommentsFromServer();
        setInterval(this.loadCommentsFromServer(), this.props.pollInterval);
    },
    render: function () {
        return (
            <div className="commentBox">
                <h1>Comments <button onClick={this.handleClear} className="btn btn-default btn-danger">Clear</button></h1>
                <CommentList onCommentDelete={this.handleCommentDelete} data={this.state.data}/>
                <CommentForm onCommentSubmit={this.handleCommentSubmit}/>
                <hr />
            </div>
        );
    }
});

var CommentList = React.createClass({
    handleCommentDelete: function (comment) {
        this.props.onCommentDelete(comment);
    },
    render: function () {
        var that = this;
        var commentNodes = this.props.data.map(function (comment) {
            return (
                <Comment onCommentDelete={that.handleCommentDelete} author={comment.author} key={comment.id} id={comment.id}>
                    {comment.text}
                </Comment>
            )
        });
        return (
            <div className="commentList">
                {commentNodes}
            </div>
        );
    }
});

var CommentForm = React.createClass({
    getInitialState: function () {
        return {author: '', text: ''};
    },
    handleAuthorChange: function (e) {
        this.setState({author: e.target.value});
    },
    handleTextChange: function (e) {
        this.setState({text: e.target.value});
    },
    handleSubmit: function (e) {
        e.preventDefault();
        var author = this.state.author.trim();
        var text = this.state.text.trim();
        if (!text || !author) {
            return;
        }
        this.props.onCommentSubmit({author: author, text: text});
        this.setState({author: '', text: ''});
    },
    render: function () {
        return (
            <form className="commentForm" onSubmit={this.handleSubmit}>
                <div className="form-group">
                    <label htmlFor="name">Name</label>
                    <input type="text" placeholder="Your name" value={this.state.author}
                           id="name" onChange={this.handleAuthorChange} className="form-control"/>
                </div>
                <div className="form-group">
                    <label htmlFor="comment">Comment</label>
                    <textarea placeholder="Say something..." value={this.state.text} rows="6"
                           id="comment" onChange={this.handleTextChange} className="form-control"/>
                </div>
                <input type="submit" value="Post" className="btn btn-default" />
            </form>
        );
    }
});

ReactDom.render(
    <CommentBox url="/api/comments" clearUrl="api/clearComments" pollInterval={2000}/>,
    document.getElementById('content')
);
