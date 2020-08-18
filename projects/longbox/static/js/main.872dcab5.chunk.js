(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{22:function(e,t,a){e.exports=a(48)},47:function(e,t,a){},48:function(e,t,a){"use strict";a.r(t);var s=a(0),n=a.n(s),r=a(20),o=a.n(r),l=a(9),c=a(3),i=a.n(c),u=a(8),m=a(4),p=a(5),h=a(7),d=a(6),b=a(2),g=a.n(b),x=a(21),f=a.n(x),C=function(e){Object(h.a)(a,e);var t=Object(d.a)(a);function a(){return Object(m.a)(this,a),t.apply(this,arguments)}return Object(p.a)(a,[{key:"render",value:function(){var e=this,t=this.props.issue.contributors?this.props.issue.contributors.map(function(t,a){return n.a.createElement("div",{key:a,className:"flex mb10 ml10"},n.a.createElement("div",{className:"mr10 w100"},n.a.createElement("label",{htmlFor:"creator_type".concat(a)},"type"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creator_type".concat(a),name:"creator_type".concat(a),value:t.creator_type,onBlur:e.props.handleContributorTextBlur,onChange:function(s){e.props.handleContributorTextChange(s,a,t.id,"creator_type")},onFocus:function(s){e.props.handleContributorTextChange(s,a,t.id,"creator_type")}})),n.a.createElement("div",{className:"wFull"},n.a.createElement("label",{htmlFor:"creator".concat(a)},"name"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creator".concat(a),name:"creator".concat(a),value:t.creator,onBlur:e.props.handleContributorTextBlur,onChange:function(s){e.props.handleContributorTextChange(s,a,t.id,"creator")},onFocus:function(s){e.props.handleContributorTextChange(s,a,t.id,"creator")}})))}):"";return n.a.createElement("form",{className:"bdrBox mb5 bdrBlack p10",id:"issue",onSubmit:this.props.addIssue},n.a.createElement("div",{className:"flex spaceBetween"},n.a.createElement("h2",{className:"mb10 bold"},this.props.issue.title,this.props.issue.number&&" #".concat(this.props.issue.number)),n.a.createElement("span",{onClick:this.props.handleClose,className:"bold csrPointer"},"X")),n.a.createElement("div",{className:"flex spaceBetween mb10"},n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_read,className:"mr5 bdrBlack p5",id:"is_read",name:"is_read",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_read"},"read")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_owned,className:"mr5 bdrBlack p5",id:"is_owned",name:"is_owned",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_owned"},"owned")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_color,className:"mr5 bdrBlack p5",id:"is_color",name:"is_color",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_color"},"color"))),n.a.createElement("div",{className:"flex mb10"},n.a.createElement("div",{className:"mr10 wFull"},n.a.createElement("label",{htmlFor:"title"},"title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"title",name:"title",onBlur:this.props.handleIssueTextBlur,onChange:this.props.handleIssueTextChange,onFocus:this.props.handleIssueTextChange,value:this.props.issue.title})),n.a.createElement("div",{className:"w100"},n.a.createElement("label",{htmlFor:"number"},"number"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"number",name:"number",onBlur:this.props.handleIssueTextBlur,onChange:this.props.handleIssueTextChange,onFocus:this.props.handleIssueTextChange,value:this.props.issue.number||""}))),n.a.createElement("div",{className:"mb10 wFull"},n.a.createElement("label",{htmlFor:"sort_title"},"sort title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"sort_title",name:"sort_title",onBlur:this.props.handleIssueTextBlur,onChange:this.props.handleIssueTextChange,onFocus:this.props.handleIssueTextChange,value:this.props.issue.sort_title})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"publisher"},"publisher"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"publisher",name:"publisher",onBlur:this.props.handleIssueTextBlur,onChange:this.props.handleIssueTextChange,onFocus:this.props.handleIssueTextChange,value:this.props.issue.publisher||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"year"},"year"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"year",name:"year",onChange:this.props.handleIssueTextChange,value:this.props.issue.year||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"format"},"format"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"format",name:"format",onBlur:this.props.handleIssueTextBlur,onChange:this.props.handleIssueTextChange,onFocus:this.props.handleIssueTextChange,value:this.props.issue.format})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"notes"},"notes"),n.a.createElement("textarea",{className:"bdrBox bdrBlack p5 wFull",id:"notes",name:"notes",onChange:this.props.handleIssueTextChange,value:this.props.issue.notes})),n.a.createElement("div",{id:"contributors"},n.a.createElement("label",null,"contributors"),t,n.a.createElement("i",{"aria-hidden":!0,className:"ml10 fs14 fas fa-plus csrPointer",onClick:this.props.addContributor})),this.props.user.isAdmin&&n.a.createElement("div",{className:"flex flexEnd mt10"},n.a.createElement("button",{className:"bdrBlack p5 csrPointer",type:"submit"},"add issue(s)")))}}]),a}(n.a.Component),E=function(e){Object(h.a)(a,e);var t=Object(d.a)(a);function a(){return Object(m.a)(this,a),t.apply(this,arguments)}return Object(p.a)(a,[{key:"render",value:function(){var e=this,t=this.props.issue.contributors?this.props.issue.contributors.map(function(t,a){return n.a.createElement("div",{key:t.id,className:"flex mb10 ml10"},n.a.createElement("div",{className:"mr10 w100"},n.a.createElement("div",{className:"flex"},n.a.createElement("label",{className:"mr5",htmlFor:"creator_type".concat(a)},"type"),n.a.createElement("span",null,"[",t.creator_type_id,"]")),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creator_type".concat(a),name:"creator_type".concat(a),value:t.creator_type,onBlur:e.props.handleContributorTextBlur,onChange:function(s){e.props.handleContributorTextChange(s,a,t.id,"creator_type")},onFocus:function(s){e.props.handleContributorTextChange(s,a,t.id,"creator_type")}})),n.a.createElement("div",{className:"wFull"},n.a.createElement("div",{className:"flex"},n.a.createElement("label",{className:"mr5",htmlFor:"creator".concat(a)},"name"),n.a.createElement("span",null,"[",t.creator_id,"]")),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creator".concat(a),name:"creator".concat(a),value:t.creator,onBlur:e.props.handleContributorTextBlur,onChange:function(s){e.props.handleContributorTextChange(s,a,t.id,"creator")},onFocus:function(s){e.props.handleContributorTextChange(s,a,t.id,"creator")}})))}):"";return n.a.createElement("form",{className:"bdrBox mb5 bdrBlack p10",id:"issue",onSubmit:this.props.updateIssue},n.a.createElement("div",{className:"flex spaceBetween"},n.a.createElement("h2",{className:"mb10 bold"},this.props.issue.title,this.props.issue.number&&" #".concat(this.props.issue.number)),n.a.createElement("span",{onClick:this.props.handleClose,className:"bold csrPointer"},"X")),n.a.createElement("div",{className:"flex spaceBetween mb10"},n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_read,className:"mr5 bdrBlack p5",id:"is_read",name:"is_read",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_read",className:"".concat(null===this.props.issue.is_read?"txtRed":"")},"read")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_owned,className:"mr5 bdrBlack p5",id:"is_owned",name:"is_owned",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_owned",className:"".concat(null===this.props.issue.is_owned?"txtRed":"")},"owned")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_color,className:"mr5 bdrBlack p5",id:"is_color",name:"is_color",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_color",className:"".concat(null===this.props.issue.is_color?"txtRed":"")},"color"))),n.a.createElement("div",{className:"flex mb10"},n.a.createElement("div",{className:"mr10 wFull"},n.a.createElement("div",{className:"flex"},n.a.createElement("label",{className:"mr5",htmlFor:"title"},"title"),n.a.createElement("span",null,"[",this.props.issue.title_id,"]")),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"title",name:"title",onBlur:this.props.handleIssueTextBlur,onChange:this.props.handleIssueTextChange,onFocus:this.props.handleIssueTextChange,value:this.props.issue.title})),n.a.createElement("div",{className:"mb10 w100"},n.a.createElement("label",{htmlFor:"number"},"number"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"number",name:"number",onBlur:this.props.handleIssueTextBlur,onChange:this.props.handleIssueTextChange,value:this.props.issue.number||""}))),n.a.createElement("div",{className:"mb10 wFull"},n.a.createElement("label",{htmlFor:"sort_title"},"sort title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"sort_title",name:"sort_title",readOnly:!0,value:this.props.issue.sort_title})),n.a.createElement("div",{className:"mb10"},n.a.createElement("div",{className:"flex"},n.a.createElement("label",{className:"mr5",htmlFor:"publisher"},"publisher"),n.a.createElement("span",null,"[",this.props.issue.publisher_id,"]")),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"publisher",name:"publisher",onBlur:this.props.handleIssueTextBlur,onChange:this.props.handleIssueTextChange,onFocus:this.props.handleIssueTextChange,value:this.props.issue.publisher||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"year"},"year"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"year",name:"year",onChange:this.props.handleIssueTextChange,value:this.props.issue.year||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("div",{className:"flex"},n.a.createElement("label",{className:"mr5",htmlFor:"format"},"format"),n.a.createElement("span",null,"[",this.props.issue.format_id,"]")),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"format",name:"format",onBlur:this.props.handleIssueTextBlur,onChange:this.props.handleIssueTextChange,onFocus:this.props.handleIssueTextChange,value:this.props.issue.format})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"notes"},"notes"),n.a.createElement("textarea",{className:"bdrBox bdrBlack p5 wFull",id:"notes",name:"notes",onChange:this.props.handleIssueTextChange,value:this.props.issue.notes})),n.a.createElement("div",null,n.a.createElement("label",null,"contributors"),t,n.a.createElement("i",{"aria-hidden":!0,className:"ml10 fs14 fas fa-plus csrPointer",onClick:this.props.addContributor})),this.props.user.isAdmin&&n.a.createElement("div",{className:"flex flexEnd mt10"},n.a.createElement("button",{className:"bdrBlack p5 csrPointer",type:"submit"},"update issue")))}}]),a}(n.a.Component),w=function(e){Object(h.a)(a,e);var t=Object(d.a)(a);function a(){return Object(m.a)(this,a),t.apply(this,arguments)}return Object(p.a)(a,[{key:"render",value:function(){return n.a.createElement("form",{id:"signInForm",onSubmit:this.props.signIn,className:"flex mb5"},n.a.createElement("div",{className:"flex bdrBox mr5 flex80"},n.a.createElement("div",{className:"mr5 flex50"},n.a.createElement("input",{type:"text",name:"username",placeholder:"username",value:this.props.username,onChange:this.props.handleLoginChange,className:"bdrBox bdrGray p5 flex100"})),n.a.createElement("div",{className:"flex50"},n.a.createElement("input",{type:"password",name:"password",placeholder:"password",value:this.props.password,onChange:this.props.handleLoginChange,className:"bdrBox bdrGray p5 flex100"}))),n.a.createElement("button",{type:"submit",className:"bdrBox bdrGray p5 flex20 csrPointer"},"sign in"))}}]),a}(n.a.PureComponent),v=function(){var e=document.cookie.split("; "),t={isAdmin:!1,isSignedIn:!1,md5:null,name:null};return e.forEach(function(e){var a=e.split("="),s=a[0],n=a[1];"user"===s&&""!==n&&(t=JSON.parse(decodeURIComponent(n)),I("user",JSON.stringify(t)))}),t},k=function(e){var t=null;return"1"===e?t=!0:"0"===e&&(t=!1),t},I=function(e,t,a){var s=arguments.length>3&&void 0!==arguments[3]?arguments[3]:"/";"undefined"===typeof a&&(a=new Date).setHours(a.getHours()+24),document.cookie="".concat(e,"=").concat(t,"; expires=").concat(a,"; path=").concat(s)},N=(a(47),function(e){Object(h.a)(a,e);var t=Object(d.a)(a);function a(e){var s;return Object(m.a)(this,a),(s=t.call(this,e)).addContributor=function(){var e=s.state.issue;e.contributors.push({creator:"",creator_type:"",id:null}),s.setState({issue:e})},s.addIssue=function(e){e.preventDefault();var t={params:{username:s.state.user.name,md5:s.state.user.md5,issue:s.state.issue}};g.a.get("https://www.rootbeercomics.com/api/longbox/add.php",t).then(function(e){e&&s.setState({issue:null,showAddIssueForm:!1,showEditIssueForm:!1},function(){s.getIssues()})})},s.autocomplete=function(){var e=Object(u.a)(i.a.mark(function e(t,a){var n,r,o,l,c,u=arguments;return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:n=u.length>2&&void 0!==u[2]?u[2]:"",r=[],o={params:{name:a,order_by:"name"}},l=document.querySelector('[id="'.concat(t+n,'"]')).getBoundingClientRect(),c="",document.querySelector("#autocomplete").style.left=l.left+"px",document.querySelector("#autocomplete").style.top=window.scrollY+l.top+l.height-1+"px",document.querySelector("#autocomplete").style.width=l.width-2+"px",e.t0=t,e.next="creator"===e.t0?11:"creator_type"===e.t0?13:"format"===e.t0?15:"publisher"===e.t0?17:"title"===e.t0?19:21;break;case 11:return c="https://www.rootbeercomics.com/api/longbox/creators.php",e.abrupt("break",22);case 13:return c="https://www.rootbeercomics.com/api/longbox/creator-types.php",e.abrupt("break",22);case 15:return c="https://www.rootbeercomics.com/api/longbox/formats.php",e.abrupt("break",22);case 17:return c="https://www.rootbeercomics.com/api/longbox/publishers.php",e.abrupt("break",22);case 19:return c="https://www.rootbeercomics.com/api/longbox/titles.php",e.abrupt("break",22);case 21:return e.abrupt("break",22);case 22:if(!c){e.next=27;break}return s.state.cancelToken&&(o.cancelToken=s.state.cancelToken.token),e.next=26,g.a.get(c,o).then(function(e){var t=[];return e&&(t=e.data.results.map(function(e){return e.name})),t}).catch(function(e){});case 26:r=e.sent;case 27:return e.abrupt("return",r?r.slice(0,5):[]);case 28:case"end":return e.stop()}},e)}));return function(t,a){return e.apply(this,arguments)}}(),s.getIssues=function(){var e={params:Object(l.a)(Object(l.a)({},s.state.search),{},{order_by:"sort_title, number"})};s.state.cancelToken&&(e.cancelToken=s.state.cancelToken.token),g.a.get("https://www.rootbeercomics.com/api/longbox/issues.php",e).then(function(e){e&&(e.data.issues.results.forEach(function(e){e.is_color=k(e.is_color),e.is_owned=k(e.is_owned),e.is_read=k(e.is_read)}),s.setState({cancelToken:null,issues:e.data.issues.results}))}).catch(function(e){})},s.handleAddIssueFormClose=function(){s.setState({showAddIssueForm:!1})},s.handleContributorTextChange=function(e,t,a,n){var r=[],o=s.state.issue,l=e.target.value;a?o.contributors.forEach(function(e){e.id===a&&(e[n]=l)}):(o.contributors[t]||(o.contributors[t]={}),o.contributors[t][n]=l),s.state.cancelToken&&s.state.cancelToken.cancel(),s.setState({cancelToken:g.a.CancelToken.source(),issue:o},Object(u.a)(i.a.mark(function e(){return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.autocomplete(n,l,t);case 2:r=e.sent,s.setState({autocomplete:r,autocompleteKey:n,autocompleteIndex:t,cancelToken:null});case 4:case"end":return e.stop()}},e)})))},s.handleContributorTextBlur=function(){var e={autocomplete:[],autocompleteIndex:null,autocompleteKey:null};if(1===s.state.autocomplete.length){var t=Object.assign({},s.state.issue);t.contributors[s.state.autocompleteIndex][s.state.autocompleteKey]=s.state.autocomplete[0],e.issue=t}setTimeout(function(){s.setState(e)},250)},s.handleIssueCheckboxChange=function(e){var t=e.target.id,a=Object.assign({},s.state.issue);a[t]=!a[t],s.setState({issue:a})},s.handleIssueTextBlur=function(){var e={autocomplete:[],autocompleteIndex:null,autocompleteKey:null};if(1===s.state.autocomplete.length){var t=Object.assign({},s.state.issue);t[s.state.autocompleteKey]=s.state.autocomplete[0],e.issue=t}setTimeout(function(){s.setState(e)},250)},s.handleIssueTextChange=function(){var e=Object(u.a)(i.a.mark(function e(t){var a,n,r,o;return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:a=[],n=s.state.issue,r=t.target.id,o=t.target.value,n[r]=o,"title"===r&&(n.sort_title=o),s.state.cancelToken&&s.state.cancelToken.cancel(),s.setState({cancelToken:g.a.CancelToken.source(),issue:n},Object(u.a)(i.a.mark(function e(){return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.autocomplete(r,o);case 2:a=e.sent,s.setState({autocomplete:a,autocompleteIndex:null,autocompleteKey:r,cancelToken:null});case 4:case"end":return e.stop()}},e)})));case 8:case"end":return e.stop()}},e)}));return function(t){return e.apply(this,arguments)}}(),s.handleLoginChange=function(e){var t=s.state.login;t[e.target.name]=e.target.value,s.setState({login:t})},s.handleSearchChange=function(e){var t=s.state.search;t.any=e.target.value,s.state.cancelToken&&s.state.cancelToken.cancel(),s.setState({cancelToken:g.a.CancelToken.source(),search:t},function(){s.getIssues()})},s.handleSuggestionClick=function(e){var t=s.state.issue;null!==s.state.autocompleteIndex?t.contributors[s.state.autocompleteIndex][s.state.autocompleteKey]=e.target.innerHTML:t[s.state.autocompleteKey]=e.target.innerHTML,"title"===s.state.autocompleteKey&&(t.sort_title=e.target.innerHTML),s.setState({autocomplete:[],autocompleteIndex:null,autocompleteKey:null,issue:t})},s.setIssue=function(e){var t=null,a=[];e&&s.state.issues.forEach(function(s){s.id===e&&((t=s).contributors&&t.contributors.forEach(function(e,t){""!==e.creator_type_id&&""!==e.creator&&a.push(e)}),t.contributors=a,window.scrollTo(0,0))}),s.setState({issue:t,showEditIssueForm:null!==t})},s.signIn=function(e){if(e.preventDefault(),""!==s.state.login.username&&""!==s.state.login.password){var t=f()(s.state.login.username+s.state.login.password),a={username:s.state.login.username,md5:t};g.a.get("https://www.rootbeercomics.com/login/ajax/index.php",{params:a}).then(function(e){if(e.data.success){var t={isAdmin:"matt!"===a.username,isSignedIn:!0,md5:a.md5,name:a.username};s.setState({showSignInForm:!1,user:t}),I("user",JSON.stringify(s.state.user))}else{var n={username:s.state.login.username,password:""};s.setState({input:n})}}).catch()}},s.signOut=function(){var e={isAdmin:!1,isSignedIn:!1,md5:"",name:""};g.a.get("https://www.rootbeercomics.com/login/ajax/log-out.php").then(function(t){s.setState({issue:null,user:e}),I("user","")})},s.toggleShowSignInForm=function(){var e=!s.state.showSignInForm;s.setState({showSignInForm:e})},s.toggleShowAddIssueForm=function(){var e=!s.state.showAddIssueForm;s.setState({issue:JSON.parse(JSON.stringify(s.state.issueDefault)),showAddIssueForm:e,showEditIssueForm:!1})},s.updateIssue=function(e){e.preventDefault();var t=s.state.issues.slice(),a={params:{username:s.state.user.name,md5:s.state.user.md5,issue:s.state.issue}};t.forEach(function(e){e.id===s.state.issue.id&&(e=s.state.issue)}),g.a.get("https://www.rootbeercomics.com/api/longbox/update.php",a).then(function(e){e&&s.setState({issue:null,issues:t,showEditIssueForm:!1})})},s.state={autocomplete:[],autocompleteIndex:null,autocompleteKey:null,cancelToken:g.a.CancelToken.source(),issue:null,issueDefault:{contributors:[{creator:"",creator_type:"writer",id:null},{creator:"",creator_type:"artist",id:null}],format:"comic",is_color:!0,is_owned:!0,is_read:!1,notes:"",number:null,publisher:"",sort_title:"",title:"",year:null},issues:[],login:{md5:"",password:"",username:""},search:{any:""},showAddIssueForm:!1,showEditIssueForm:!1,showSignInForm:!1,user:v()},s}return Object(p.a)(a,[{key:"componentDidMount",value:function(){this.getIssues()}},{key:"render",value:function(){var e=this,t=this.state.user.isSignedIn?n.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-out-alt csrPointer",onClick:this.signOut}):n.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-in-alt csrPointer",onClick:this.toggleShowSignInForm});return n.a.createElement("div",{className:"mAuto w600"},n.a.createElement("div",{className:"flex spaceBetween alignCenter mb5 fs14"},n.a.createElement("div",{className:"flex alignCenter mr10"},n.a.createElement("i",{"aria-hidden":!0,className:"mr10 fs14 fas fa-book-open csrPointer",onClick:function(){window.location.reload()}}),n.a.createElement("h1",{className:"fs14 bold csrPointer",onClick:function(){window.location.reload()}},"longbox")),n.a.createElement("div",{className:"flex alignCenter"},this.state.user.isAdmin&&n.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-edit ".concat(this.state.showAddIssueForm?"":"txtRed"," csrPointer"),onClick:this.toggleShowAddIssueForm}),t)),this.state.showSignInForm&&n.a.createElement(w,{handleLoginChange:this.handleLoginChange,password:this.state.login.password,signIn:this.signIn,username:this.state.login.username}),!this.state.showAddIssueForm&&!this.state.showEditIssueForm&&n.a.createElement("section",{id:"search",className:"mb5"},n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",name:"any",onChange:this.handleSearchChange,placeholder:"search by title, publisher, contributor, or notes",value:this.state.search.any})),this.state.showAddIssueForm&&n.a.createElement(C,{addContributor:this.addContributor,handleClose:this.handleAddIssueFormClose,handleContributorTextBlur:this.handleContributorTextBlur,handleContributorTextChange:this.handleContributorTextChange,handleIssueCheckboxChange:this.handleIssueCheckboxChange,handleIssueTextBlur:this.handleIssueTextBlur,handleIssueTextChange:this.handleIssueTextChange,issue:this.state.issue,addIssue:this.addIssue,user:this.state.user}),this.state.showEditIssueForm&&n.a.createElement(E,{addContributor:this.addContributor,handleClose:this.setIssue,handleContributorTextBlur:this.handleContributorTextBlur,handleContributorTextChange:this.handleContributorTextChange,handleIssueCheckboxChange:this.handleIssueCheckboxChange,handleIssueTextBlur:this.handleIssueTextBlur,handleIssueTextChange:this.handleIssueTextChange,issue:this.state.issue,updateIssue:this.updateIssue,user:this.state.user}),!this.state.showAddIssueForm&&!this.state.showEditIssueForm&&n.a.createElement("section",{id:"list",className:"bdrBox mb5 bdrBlack p5"},this.state.issues.length>0?this.state.issues.map(function(t,a){return n.a.createElement("div",{key:a},n.a.createElement("span",{onClick:function(){e.setIssue(t.id)},className:"csrPointer"},a+1,". ",t.title,t.number?" #".concat(t.number):""))}):n.a.createElement("div",null,"...")),n.a.createElement("div",{className:"absolute bdrBlack bgWhite overflow-hidden ".concat(this.state.autocomplete.length>0?"":"hidden"),id:"autocomplete"},this.state.autocomplete.map(function(t,a){return n.a.createElement("div",{className:"suggestion p5",key:a,onClick:e.handleSuggestionClick},t)})))}}]),a}(n.a.Component));o.a.render(n.a.createElement(N,null),document.getElementById("root"))}},[[22,1,2]]]);
//# sourceMappingURL=main.872dcab5.chunk.js.map