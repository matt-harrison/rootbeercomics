(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{21:function(e,a,t){e.exports=t(46)},46:function(e,a,t){"use strict";t.r(a);var s=t(0),n=t.n(s),r=t(18),l=t.n(r),i=t(20),o=t(2),c=t(3),m=t(5),u=t(4),d=t(6),h=t(7),p=t.n(h),b=t(19),g=t.n(b),E=function(e){function a(){return Object(o.a)(this,a),Object(m.a)(this,Object(u.a)(a).apply(this,arguments))}return Object(d.a)(a,e),Object(c.a)(a,[{key:"render",value:function(){var e=this,a=this.props.issue&&this.props.issue.contributors?this.props.issue.contributors.map(function(a){return n.a.createElement("div",{key:a.id,className:"flex mb5 ml10"},n.a.createElement("div",{className:"mr10 w100"},n.a.createElement("label",{htmlFor:"creatorType".concat(a.id)},"type"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creatorType".concat(a.id),name:"creatorType".concat(a.id),value:a.creator_type,onChange:function(t){e.handleContributorTextChange(t,a.id,"creator_type")}})),n.a.createElement("div",{className:"wFull"},n.a.createElement("label",{htmlFor:"creator".concat(a.id)},"name"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creator".concat(a.id),name:"creator".concat(a.id),value:a.creator,onChange:function(t){e.handleContributorTextChange(t,a.id,"creator")}})))}):"";return n.a.createElement("form",{className:"bdrBox mb5 bdrBlack p10",id:"issue",onSubmit:this.props.addIssue},n.a.createElement("div",{className:"flex spaceBetween"},n.a.createElement("h2",{className:"mb10 bold"},this.props.issue.title,this.props.issue.number&&" #".concat(this.props.issue.number)),n.a.createElement("span",{onClick:this.props.handleClose,className:"bold csrPointer"},"X")),n.a.createElement("div",{className:"flex spaceBetween mb10"},n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_read,className:"mr5 bdrBlack p5",id:"is_read",name:"is_read",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_read"},"read")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_owned,className:"mr5 bdrBlack p5",id:"is_owned",name:"is_owned",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_owned"},"owned")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_color,className:"mr5 bdrBlack p5",id:"is_color",name:"is_color",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_color"},"color"))),n.a.createElement("div",{className:"flex mb10"},n.a.createElement("div",{className:"mr10 wFull"},n.a.createElement("label",{htmlFor:"title"},"title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"title",name:"title",onChange:this.props.handleIssueTextChange,value:this.props.issue.title})),n.a.createElement("div",{className:"w100"},n.a.createElement("label",{htmlFor:"number"},"number"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"number",name:"number",onChange:this.props.handleIssueTextChange,value:this.props.issue.number||""}))),n.a.createElement("div",{className:"mb10 wFull"},n.a.createElement("label",{htmlFor:"sort_title"},"sort title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"sort_title",name:"sort_title",onChange:this.props.handleIssueTextChange,value:this.props.issue.sort_title})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"publisher"},"publisher"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"publisher",name:"publisher",onChange:this.props.handleIssueTextChange,value:this.props.issue.publisher||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"year"},"year"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"year",name:"year",onChange:this.props.handleIssueTextChange,value:this.props.issue.year||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"format"},"format"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"format",name:"format",onChange:this.props.handleIssueTextChange,value:this.props.issue.format})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"notes"},"notes"),n.a.createElement("textarea",{className:"bdrBox bdrBlack p5 wFull",id:"notes",name:"notes",onChange:this.props.handleIssueTextChange,value:this.props.issue.notes})),a&&n.a.createElement("div",null,n.a.createElement("label",{className:"mb5"},"contributors"),a),this.props.user.isAdmin&&n.a.createElement("div",{className:"flex flexEnd mt10"},n.a.createElement("button",{className:"bdrBlack p5 csrPointer",type:"submit"},"add")))}}]),a}(n.a.Component),f=function(e){function a(){return Object(o.a)(this,a),Object(m.a)(this,Object(u.a)(a).apply(this,arguments))}return Object(d.a)(a,e),Object(c.a)(a,[{key:"render",value:function(){var e=this,a=this.props.issue&&this.props.issue.contributors?this.props.issue.contributors.map(function(a){return n.a.createElement("div",{key:a.id,className:"flex mb5 ml10"},n.a.createElement("div",{className:"mr10 w100"},n.a.createElement("label",{htmlFor:"creatorType".concat(a.id)},"type"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creatorType".concat(a.id),name:"creatorType".concat(a.id),value:a.creator_type,onChange:function(t){e.handleContributorTextChange(t,a.id,"creator_type")}})),n.a.createElement("div",{className:"wFull"},n.a.createElement("label",{htmlFor:"creator".concat(a.id)},"name"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creator".concat(a.id),name:"creator".concat(a.id),value:a.creator,onChange:function(t){e.handleContributorTextChange(t,a.id,"creator")}})))}):"";return n.a.createElement("form",{className:"bdrBox mb5 bdrBlack p10",id:"issue",onSubmit:this.props.updateIssue},n.a.createElement("div",{className:"flex spaceBetween"},n.a.createElement("h2",{className:"mb10 bold"},this.props.issue.title,this.props.issue.number&&" #".concat(this.props.issue.number)),n.a.createElement("span",{onClick:this.props.handleClose,className:"bold csrPointer"},"X")),n.a.createElement("div",{className:"flex spaceBetween mb10"},n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_read,className:"mr5 bdrBlack p5",id:"is_read",name:"is_read",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_read",className:"".concat(null===this.props.issue.is_read?"txtRed":"")},"read")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_owned,className:"mr5 bdrBlack p5",id:"is_owned",name:"is_owned",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_owned",className:"".concat(null===this.props.issue.is_owned?"txtRed":"")},"owned")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_color,className:"mr5 bdrBlack p5",id:"is_color",name:"is_color",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_color",className:"".concat(null===this.props.issue.is_color?"txtRed":"")},"color"))),n.a.createElement("div",{className:"flex mb10"},n.a.createElement("div",{className:"mr10 wFull"},n.a.createElement("label",{htmlFor:"title"},"title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"title",name:"title",onChange:this.props.handleIssueTextChange,value:this.props.issue.title})),n.a.createElement("div",{className:"mb10 w100"},n.a.createElement("label",{htmlFor:"number"},"number"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"number",name:"number",onChange:this.props.handleIssueTextChange,value:this.props.issue.number||""}))),n.a.createElement("div",{className:"mb10 wFull"},n.a.createElement("label",{htmlFor:"sort_title"},"sort title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"sort_title",name:"sort_title",readOnly:!0,value:this.props.issue.sort_title})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"publisher"},"publisher"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"publisher",name:"publisher",onChange:this.props.handleIssueTextChange,value:this.props.issue.publisher||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"year"},"year"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"year",name:"year",onChange:this.props.handleIssueTextChange,value:this.props.issue.year||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"format"},"format"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"format",name:"format",onChange:this.props.handleIssueTextChange,value:this.props.issue.format})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"notes"},"notes"),n.a.createElement("textarea",{className:"bdrBox bdrBlack p5 wFull",id:"notes",name:"notes",onChange:this.props.handleIssueTextChange,value:this.props.issue.notes})),a&&n.a.createElement("div",null,n.a.createElement("label",{className:"mb5"},"contributors"),a),this.props.user.isAdmin&&n.a.createElement("div",{className:"flex flexEnd mt10"},n.a.createElement("button",{className:"bdrBlack p5 csrPointer",type:"submit"},"update")))}}]),a}(n.a.Component),w=function(e){function a(){return Object(o.a)(this,a),Object(m.a)(this,Object(u.a)(a).apply(this,arguments))}return Object(d.a)(a,e),Object(c.a)(a,[{key:"render",value:function(){return n.a.createElement("form",{id:"signInForm",onSubmit:this.props.signIn,className:"flex mb5"},n.a.createElement("div",{className:"flex bdrBox mr5 flex80"},n.a.createElement("div",{className:"mr5 flex50"},n.a.createElement("input",{type:"text",name:"username",placeholder:"username",value:this.props.username,onChange:this.props.handleLoginChange,className:"bdrBox bdrGray p5 flex100"})),n.a.createElement("div",{className:"flex50"},n.a.createElement("input",{type:"password",name:"password",placeholder:"password",value:this.props.password,onChange:this.props.handleLoginChange,className:"bdrBox bdrGray p5 flex100"}))),n.a.createElement("button",{type:"submit",className:"bdrBox bdrGray p5 flex20 csrPointer"},"sign in"))}}]),a}(n.a.PureComponent),x=function(){var e=document.cookie.split("; "),a={isAdmin:!1,isSignedIn:!1,md5:null,name:null};return e.forEach(function(e){var t=e.split("="),s=t[0],n=t[1];"user"===s&&""!==n&&(a=JSON.parse(decodeURIComponent(n)),N("user",JSON.stringify(a)))}),a},C=function(e){var a=null;return"1"===e?a=!0:"0"===e&&(a=!1),a},N=function(e,a,t){var s=arguments.length>3&&void 0!==arguments[3]?arguments[3]:"/";"undefined"===typeof t&&(t=new Date).setHours(t.getHours()+24),document.cookie="".concat(e,"=").concat(a,"; expires=").concat(t,"; path=").concat(s)};t.e(3).then(t.t.bind(null,47,7));var v=function(e){function a(e){var t;return Object(o.a)(this,a),(t=Object(m.a)(this,Object(u.a)(a).call(this,e))).addIssue=function(e){e.preventDefault();var a={params:{username:t.state.user.name,md5:t.state.user.md5,issue:t.state.issueNew}};t.state.cancelToken&&(a.cancelToken=t.state.cancelToken.token),p.a.get("https://www.rootbeercomics.com/api/longbox/add.php",a).then(function(e){e&&t.setState({cancelToken:null,issueNew:null,showEditIssueForm:!1})})},t.getIssues=function(){var e={params:Object(i.a)({},t.state.search,{order_by:"sort_title, number"})};t.state.cancelToken&&(e.cancelToken=t.state.cancelToken.token),p.a.get("https://www.rootbeercomics.com/api/longbox/get.php",e).then(function(e){e&&(e.data.issues.results.forEach(function(e){e.is_color=C(e.is_color),e.is_owned=C(e.is_owned),e.is_read=C(e.is_read)}),t.setState({cancelToken:null,issues:e.data.issues.results}))})},t.handleAddIssueFormClose=function(){t.setState({showAddIssueForm:!1})},t.handleContributorTextChange=function(e,a,s){var n=t.state.issue;n.contributors.forEach(function(t){t.id===a&&(t[s]=e.target.value)}),t.setState({issue:n})},t.handleIssueCheckboxChange=function(e){var a=e.target.id,s=t.state.issue;s[a]=!s[a],t.setState({issue:s})},t.handleIssueNewCheckboxChange=function(e){var a=e.target.id,s=t.state.issueNew;s[a]=!s[a],t.setState({issueNew:s})},t.handleIssueNewTextChange=function(e){var a=e.target.id,s=t.state.issueNew;s[a]=e.target.value,t.setState({issueNew:s})},t.handleIssueTextChange=function(e){var a=e.target.id,s=t.state.issue;s[a]=e.target.value,t.setState({issue:s})},t.handleLoginChange=function(e){var a=t.state.login;a[e.target.name]=e.target.value,t.setState({login:a})},t.handleSearchChange=function(e){var a=t.state.search;a.any=e.target.value,t.state.cancelToken&&t.state.cancelToken.cancel(),t.setState({cancelToken:p.a.CancelToken.source(),search:a},function(){t.getIssues()})},t.setIssue=function(e){var a=null;e&&t.state.issues.forEach(function(t){t.id===e&&(a=t,window.scrollTo(0,0))}),t.setState({issue:a,showEditIssueForm:null!==a})},t.signIn=function(e){e.preventDefault();var a=g()(t.state.login.username+t.state.login.password),s={username:t.state.login.username,md5:a};p.a.get("https://www.rootbeercomics.com/login/ajax/index.php",{params:s}).then(function(e){if(e.data.success){var a={isAdmin:"matt!"===s.username,isSignedIn:!0,md5:s.md5,name:s.username};t.setState({showSignInForm:!1,user:a}),N("user",JSON.stringify(t.state.user))}else{var n={username:t.state.login.username,password:""};t.setState({input:n})}})},t.signOut=function(){var e={isAdmin:!1,isSignedIn:!1,md5:"",name:""};p.a.get("https://www.rootbeercomics.com/login/ajax/log-out.php").then(function(a){t.setState({issue:null,user:e}),N("user","")})},t.toggleShowSignInForm=function(){var e=!t.state.showSignInForm;t.setState({showSignInForm:e})},t.toggleShowAddIssueForm=function(){var e={showAddIssueForm:!t.state.showAddIssueForm};null===t.state.issueNew&&(e.issueNew=Object.assign({},t.state.issueDefault)),t.setState(e)},t.updateIssue=function(e){e.preventDefault();var a=t.state.issues.slice(),s={params:{username:t.state.user.name,md5:t.state.user.md5,issue:t.state.issue}};a.forEach(function(e){e.id===t.state.issue.id&&(e=t.state.issue)}),t.state.cancelToken&&(s.cancelToken=t.state.cancelToken.token),p.a.get("https://www.rootbeercomics.com/api/longbox/update.php",s).then(function(e){e&&t.setState({cancelToken:null,issue:null,issues:a,showEditIssueForm:!1})})},t.state={cancelToken:null,issue:null,issueDefault:{contributors:[],format:"",is_color:!1,is_owned:!0,is_read:!0,notes:"",number:null,publisher:"",sort_title:"",title:"",year:null},issueNew:null,issues:[],login:{md5:null,username:null},search:{any:""},showAddIssueForm:!1,showEditIssueForm:!1,showSignInForm:!1,user:x()},t}return Object(d.a)(a,e),Object(c.a)(a,[{key:"componentDidMount",value:function(){this.getIssues()}},{key:"render",value:function(){var e=this,a=this.state.user.isSignedIn?n.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-out-alt csrPointer",onClick:this.signOut}):n.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-in-alt csrPointer",onClick:this.toggleShowSignInForm});return n.a.createElement("div",{className:"mAuto w600"},n.a.createElement("div",{className:"flex spaceBetween alignCenter mb5 fs14"},n.a.createElement("div",{className:"flex alignCenter mr10"},n.a.createElement("i",{"aria-hidden":!0,className:"mr10 fs14 fas fa-book-open csrPointer",onClick:function(){window.location.reload()}}),n.a.createElement("h1",{className:"fs14 bold csrPointer",onClick:function(){window.location.reload()}},"longbox")),n.a.createElement("div",{className:"flex alignCenter"},this.state.user.isAdmin&&n.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-edit ".concat(this.state.showAddIssueForm?"":"txtRed"," csrPointer"),onClick:this.toggleShowAddIssueForm}),a)),this.state.showSignInForm&&n.a.createElement(w,{signIn:this.signIn,username:this.state.login.username,password:this.state.login.password,handleLoginChange:this.handleLoginChange}),!this.state.showAddIssueForm&&!this.state.showEditIssueForm&&n.a.createElement("section",{id:"search",className:"mb5"},n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",name:"any",onChange:this.handleSearchChange,placeholder:"search by title, publisher, contributor, or notes",value:this.state.search.any})),this.state.showAddIssueForm&&n.a.createElement(E,{handleClose:this.handleAddIssueFormClose,handleIssueCheckboxChange:this.handleIssueNewCheckboxChange,handleIssueTextChange:this.handleIssueNewTextChange,issue:this.state.issueNew,addIssue:this.addIssue,user:this.state.user}),this.state.showEditIssueForm&&n.a.createElement(f,{handleClose:this.setIssue,handleIssueCheckboxChange:this.handleIssueCheckboxChange,handleIssueTextChange:this.handleIssueTextChange,issue:this.state.issue,updateIssue:this.updateIssue,user:this.state.user}),!this.state.showAddIssueForm&&!this.state.showEditIssueForm&&n.a.createElement("section",{id:"list",className:"bdrBox mb5 bdrBlack p5"},this.state.issues.length>0?this.state.issues.map(function(a,t){return n.a.createElement("div",{key:t},n.a.createElement("span",{onClick:function(){e.setIssue(a.id)},className:"csrPointer"},t+1,". ",a.title,a.number?" #".concat(a.number):""))}):n.a.createElement("div",null,"...")))}}]),a}(n.a.Component);l.a.render(n.a.createElement(v,null),document.getElementById("root"))}},[[21,1,2]]]);
//# sourceMappingURL=main.2aabc8d7.chunk.js.map