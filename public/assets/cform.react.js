var CForm = React.createClass({
    render: function() {
        return <form className="cform" method="post" action="/contact">
            <div className="row">
                <div className="col-md-12 padding10">
                    <ContactDropDown />
                </div>
                <div className="col-md-12 padding10">
                    <input type="text" name="subject" placeholder="your subject" className="form-control"/>
                </div>
                <div className="col-md-12 padding10">
                    <ContactTextArea />
                </div>
                <div className="col-md-12 padding10">
                    <ContactFormButton value="Send."/>
                </div>
            </div>
            <input type="hidden" name="_token" value={this.csrfToken()}/>
        </form>
    },
    csrfToken: function(){
        return $('meta[name="csrf-token"]').attr('content');
    }
});
var ContactDropDown = React.createClass({
    getInitialState: function(){
        return {
            contacts: []
        }
    },
    render: function(){
        return <div>
            <select name="contact" className="form-control">
                {this.state.contacts.map(function(contact){
                    console.log('mapping');
                    console.log(contact);
                    return <option value={contact.id}>{contact.title}</option>
                })}
            </select>
           </div>

    },

    componentDidMount: function(){
        //console.log('mounted');
        this.populateDropDown();
    },
    populateDropDown: function(){
        //console.log('populating drop down');
        console.log('get contacts for user: '+window.user);
        $.get('/contacts/?token='+window.user, function(response){
            this.setState({contacts: response.contacts});
        }.bind(this));
        console.log(this.state.contacts);
    }

});
var ContactFormButton = React.createClass({
    render: function(){
        return <button>{this.props.value}</button>
    }
});

var ContactTextArea = React.createClass({
    render: function () {
        return <textarea className="form-control" name="mymessage"></textarea>
    }
});
ReactDOM.render(<CForm />, document.getElementById('react-contact-form'));