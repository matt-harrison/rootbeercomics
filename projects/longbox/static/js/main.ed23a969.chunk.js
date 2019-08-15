(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{21:function(e,t,a){e.exports=a(46)},46:function(e,t,a){"use strict";a.r(t);var s=a(0),n=a.n(s),r=a(18),l=a.n(r),o=a(20),i=a(2),c=a(3),u=a(5),m=a(4),d=a(6),h=a(7),p=a.n(h),b=a(19),g=a.n(b),E=function(e){function t(e){var a;return Object(i.a)(this,t),(a=Object(u.a)(this,Object(m.a)(t).call(this,e))).addContributor=function(){var e=a.state.contributors;e.push({creator:"",creator_type:"",id:null}),a.setState({contributors:e})},a.state={contributors:a.props.issue.contributors},a}return Object(d.a)(t,e),Object(c.a)(t,[{key:"render",value:function(){var e=this,t=this.state.contributors?this.state.contributors.map(function(t,a){return n.a.createElement("div",{key:a,className:"flex mb10 ml10"},n.a.createElement("div",{className:"mr10 w100"},n.a.createElement("label",{htmlFor:"creatorType".concat(a)},"type"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creatorType".concat(a),name:"creatorType".concat(a),value:t.creator_type,onChange:function(s){e.props.handleContributorTextChange(s,a,t,"creator_type")}})),n.a.createElement("div",{className:"wFull"},n.a.createElement("label",{htmlFor:"creator".concat(a)},"name"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creator".concat(a),name:"creator".concat(a),value:t.creator,onChange:function(s){e.props.handleContributorTextChange(s,a,t,"creator")}})))}):"";return n.a.createElement("form",{className:"bdrBox mb5 bdrBlack p10",id:"issue",onSubmit:this.props.addIssue},n.a.createElement("div",{className:"flex spaceBetween"},n.a.createElement("h2",{className:"mb10 bold"},this.props.issue.title,this.props.issue.number&&" #".concat(this.props.issue.number)),n.a.createElement("span",{onClick:this.props.handleClose,className:"bold csrPointer"},"X")),n.a.createElement("div",{className:"flex spaceBetween mb10"},n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_read,className:"mr5 bdrBlack p5",id:"is_read",name:"is_read",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_read"},"read")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_owned,className:"mr5 bdrBlack p5",id:"is_owned",name:"is_owned",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_owned"},"owned")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_color,className:"mr5 bdrBlack p5",id:"is_color",name:"is_color",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_color"},"color"))),n.a.createElement("div",{className:"flex mb10"},n.a.createElement("div",{className:"mr10 wFull"},n.a.createElement("label",{htmlFor:"title"},"title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"title",name:"title",onChange:this.props.handleIssueTextChange,value:this.props.issue.title})),n.a.createElement("div",{className:"w100"},n.a.createElement("label",{htmlFor:"number"},"number"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"number",name:"number",onChange:this.props.handleIssueTextChange,value:this.props.issue.number||""}))),n.a.createElement("div",{className:"mb10 wFull"},n.a.createElement("label",{htmlFor:"sort_title"},"sort title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"sort_title",name:"sort_title",onChange:this.props.handleIssueTextChange,value:this.props.issue.sort_title})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"publisher"},"publisher"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"publisher",name:"publisher",onChange:this.props.handleIssueTextChange,value:this.props.issue.publisher||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"year"},"year"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"year",name:"year",onChange:this.props.handleIssueTextChange,value:this.props.issue.year||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"format"},"format"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"format",name:"format",onChange:this.props.handleIssueTextChange,value:this.props.issue.format})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"notes"},"notes"),n.a.createElement("textarea",{className:"bdrBox bdrBlack p5 wFull",id:"notes",name:"notes",onChange:this.props.handleIssueTextChange,value:this.props.issue.notes})),n.a.createElement("div",{id:"contributors"},n.a.createElement("label",null,"contributors"),t,n.a.createElement("i",{"aria-hidden":!0,className:"ml10 fs14 fas fa-plus csrPointer",onClick:this.addContributor})),this.props.user.isAdmin&&n.a.createElement("div",{className:"flex flexEnd mt10"},n.a.createElement("button",{className:"bdrBlack p5 csrPointer",type:"submit"},"add issue(s)")))}}]),t}(n.a.Component),f=function(e){function t(e){var a;return Object(i.a)(this,t),(a=Object(u.a)(this,Object(m.a)(t).call(this,e))).addContributor=function(){var e=a.state.contributors;e.push({creator:"",creator_type:"",id:null}),a.setState({contributors:e})},a.state={contributors:a.props.issue.contributors},a}return Object(d.a)(t,e),Object(c.a)(t,[{key:"render",value:function(){var e=this,t=this.state.contributors?this.state.contributors.map(function(t,a){return n.a.createElement("div",{key:t.id,className:"flex mb10 ml10"},n.a.createElement("div",{className:"mr10 w100"},n.a.createElement("label",{htmlFor:"creatorType".concat(t.id)},"type"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creatorType".concat(t.id),name:"creatorType".concat(t.id),value:t.creator_type,onChange:function(s){e.props.handleContributorTextChange(s,a,t,"creator_type")}})),n.a.createElement("div",{className:"wFull"},n.a.createElement("label",{htmlFor:"creator".concat(t.id)},"name"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"creator".concat(t.id),name:"creator".concat(t.id),value:t.creator,onChange:function(s){e.props.handleContributorTextChange(s,a,t,"creator")}})))}):"";return n.a.createElement("form",{className:"bdrBox mb5 bdrBlack p10",id:"issue",onSubmit:this.props.updateIssue},n.a.createElement("div",{className:"flex spaceBetween"},n.a.createElement("h2",{className:"mb10 bold"},this.props.issue.title,this.props.issue.number&&" #".concat(this.props.issue.number)),n.a.createElement("span",{onClick:this.props.handleClose,className:"bold csrPointer"},"X")),n.a.createElement("div",{className:"flex spaceBetween mb10"},n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_read,className:"mr5 bdrBlack p5",id:"is_read",name:"is_read",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_read",className:"".concat(null===this.props.issue.is_read?"txtRed":"")},"read")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_owned,className:"mr5 bdrBlack p5",id:"is_owned",name:"is_owned",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_owned",className:"".concat(null===this.props.issue.is_owned?"txtRed":"")},"owned")),n.a.createElement("div",{className:"flex"},n.a.createElement("input",{checked:this.props.issue.is_color,className:"mr5 bdrBlack p5",id:"is_color",name:"is_color",onChange:this.props.handleIssueCheckboxChange,type:"checkbox"}),n.a.createElement("label",{htmlFor:"is_color",className:"".concat(null===this.props.issue.is_color?"txtRed":"")},"color"))),n.a.createElement("div",{className:"flex mb10"},n.a.createElement("div",{className:"mr10 wFull"},n.a.createElement("label",{htmlFor:"title"},"title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"title",name:"title",onChange:this.props.handleIssueTextChange,value:this.props.issue.title})),n.a.createElement("div",{className:"mb10 w100"},n.a.createElement("label",{htmlFor:"number"},"number"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"number",name:"number",onChange:this.props.handleIssueTextChange,value:this.props.issue.number||""}))),n.a.createElement("div",{className:"mb10 wFull"},n.a.createElement("label",{htmlFor:"sort_title"},"sort title"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"sort_title",name:"sort_title",readOnly:!0,value:this.props.issue.sort_title})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"publisher"},"publisher"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"publisher",name:"publisher",onChange:this.props.handleIssueTextChange,value:this.props.issue.publisher||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"year"},"year"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"year",name:"year",onChange:this.props.handleIssueTextChange,value:this.props.issue.year||""})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"format"},"format"),n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",id:"format",name:"format",onChange:this.props.handleIssueTextChange,value:this.props.issue.format})),n.a.createElement("div",{className:"mb10"},n.a.createElement("label",{htmlFor:"notes"},"notes"),n.a.createElement("textarea",{className:"bdrBox bdrBlack p5 wFull",id:"notes",name:"notes",onChange:this.props.handleIssueTextChange,value:this.props.issue.notes})),n.a.createElement("div",null,n.a.createElement("label",null,"contributors"),t,n.a.createElement("i",{"aria-hidden":!0,className:"ml10 fs14 fas fa-plus csrPointer",onClick:this.addContributor})),this.props.user.isAdmin&&n.a.createElement("div",{className:"flex flexEnd mt10"},n.a.createElement("button",{className:"bdrBlack p5 csrPointer",type:"submit"},"update issue")))}}]),t}(n.a.Component),C=function(e){function t(){return Object(i.a)(this,t),Object(u.a)(this,Object(m.a)(t).apply(this,arguments))}return Object(d.a)(t,e),Object(c.a)(t,[{key:"render",value:function(){return n.a.createElement("form",{id:"signInForm",onSubmit:this.props.signIn,className:"flex mb5"},n.a.createElement("div",{className:"flex bdrBox mr5 flex80"},n.a.createElement("div",{className:"mr5 flex50"},n.a.createElement("input",{type:"text",name:"username",placeholder:"username",value:this.props.username,onChange:this.props.handleLoginChange,className:"bdrBox bdrGray p5 flex100"})),n.a.createElement("div",{className:"flex50"},n.a.createElement("input",{type:"password",name:"password",placeholder:"password",value:this.props.password,onChange:this.props.handleLoginChange,className:"bdrBox bdrGray p5 flex100"}))),n.a.createElement("button",{type:"submit",className:"bdrBox bdrGray p5 flex20 csrPointer"},"sign in"))}}]),t}(n.a.PureComponent),x=function(){var e=document.cookie.split("; "),t={isAdmin:!1,isSignedIn:!1,md5:null,name:null};return e.forEach(function(e){var a=e.split("="),s=a[0],n=a[1];"user"===s&&""!==n&&(t=JSON.parse(decodeURIComponent(n)),v("user",JSON.stringify(t)))}),t},w=function(e){var t=null;return"1"===e?t=!0:"0"===e&&(t=!1),t},v=function(e,t,a){var s=arguments.length>3&&void 0!==arguments[3]?arguments[3]:"/";"undefined"===typeof a&&(a=new Date).setHours(a.getHours()+24),document.cookie="".concat(e,"=").concat(t,"; expires=").concat(a,"; path=").concat(s)};a.e(3).then(a.t.bind(null,47,7));var k=function(e){function t(e){var a;return Object(i.a)(this,t),(a=Object(u.a)(this,Object(m.a)(t).call(this,e))).addIssue=function(e){e.preventDefault();var t={params:{username:a.state.user.name,md5:a.state.user.md5,issue:a.state.issue}};a.state.cancelToken&&(t.cancelToken=a.state.cancelToken.token),p.a.get("https://www.rootbeercomics.com/api/longbox/add.php",t).then(function(e){e&&a.setState({cancelToken:null,issue:null,showAddIssueForm:!1,showEditIssueForm:!1})})},a.getIssues=function(){var e={params:Object(o.a)({},a.state.search,{order_by:"sort_title, number"})};a.state.cancelToken&&(e.cancelToken=a.state.cancelToken.token),p.a.get("https://www.rootbeercomics.com/api/longbox/get.php",e).then(function(e){e&&(e.data.issues.results.forEach(function(e){e.is_color=w(e.is_color),e.is_owned=w(e.is_owned),e.is_read=w(e.is_read)}),a.setState({cancelToken:null,issues:e.data.issues.results}))})},a.handleAddIssueFormClose=function(){a.setState({showAddIssueForm:!1})},a.handleContributorTextChange=function(e,t,s,n){var r=a.state.issue;s.id?r.contributors.forEach(function(t){t.id===s.id&&(t[n]=e.target.value)}):(r.contributors[t]||(r.contributors[t]={}),r.contributors[t][n]=e.target.value),a.setState({issue:r})},a.handleIssueCheckboxChange=function(e){var t=e.target.id,s=a.state.issue;s[t]=!s[t],a.setState({issue:s})},a.handleIssueTextChange=function(e){var t=e.target.id,s=a.state.issue;s[t]=e.target.value,a.setState({issue:s})},a.handleLoginChange=function(e){var t=a.state.login;t[e.target.name]=e.target.value,a.setState({login:t})},a.handleSearchChange=function(e){var t=a.state.search;t.any=e.target.value,a.state.cancelToken&&a.state.cancelToken.cancel(),a.setState({cancelToken:p.a.CancelToken.source(),search:t},function(){a.getIssues()})},a.setIssue=function(e){var t=null,s=[];e&&a.state.issues.forEach(function(a){a.id===e&&((t=a).contributors&&t.contributors.forEach(function(e,t){""!==e.creator_type_id&&""!==e.creator&&s.push(e)}),t.contributors=s,window.scrollTo(0,0))}),a.setState({issue:t,showEditIssueForm:null!==t})},a.signIn=function(e){e.preventDefault();var t=g()(a.state.login.username+a.state.login.password),s={username:a.state.login.username,md5:t};p.a.get("https://www.rootbeercomics.com/login/ajax/index.php",{params:s}).then(function(e){if(e.data.success){var t={isAdmin:"matt!"===s.username,isSignedIn:!0,md5:s.md5,name:s.username};a.setState({showSignInForm:!1,user:t}),v("user",JSON.stringify(a.state.user))}else{var n={username:a.state.login.username,password:""};a.setState({input:n})}})},a.signOut=function(){var e={isAdmin:!1,isSignedIn:!1,md5:"",name:""};p.a.get("https://www.rootbeercomics.com/login/ajax/log-out.php").then(function(t){a.setState({issue:null,user:e}),v("user","")})},a.toggleShowSignInForm=function(){var e=!a.state.showSignInForm;a.setState({showSignInForm:e})},a.toggleShowAddIssueForm=function(){var e={showAddIssueForm:!a.state.showAddIssueForm,showEditIssueForm:!1};null===a.state.issue&&(e.issue=Object.assign({},a.state.issueDefault)),a.setState(e)},a.updateIssue=function(e){e.preventDefault();var t=a.state.issues.slice(),s={params:{username:a.state.user.name,md5:a.state.user.md5,issue:a.state.issue}};t.forEach(function(e){e.id===a.state.issue.id&&(e=a.state.issue)}),a.state.cancelToken&&(s.cancelToken=a.state.cancelToken.token),p.a.get("https://www.rootbeercomics.com/api/longbox/update.php",s).then(function(e){e&&a.setState({cancelToken:null,issue:null,issues:t,showEditIssueForm:!1})})},a.state={cancelToken:null,issue:null,issueDefault:{contributors:[],format:"",is_color:!1,is_owned:!0,is_read:!0,notes:"",number:null,publisher:"",sort_title:"",title:"",year:null},issues:[],login:{md5:null,username:null},search:{any:""},showAddIssueForm:!1,showEditIssueForm:!1,showSignInForm:!1,user:x()},a}return Object(d.a)(t,e),Object(c.a)(t,[{key:"componentDidMount",value:function(){this.getIssues()}},{key:"render",value:function(){var e=this,t=this.state.user.isSignedIn?n.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-out-alt csrPointer",onClick:this.signOut}):n.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-in-alt csrPointer",onClick:this.toggleShowSignInForm});return n.a.createElement("div",{className:"mAuto w600"},n.a.createElement("div",{className:"flex spaceBetween alignCenter mb5 fs14"},n.a.createElement("div",{className:"flex alignCenter mr10"},n.a.createElement("i",{"aria-hidden":!0,className:"mr10 fs14 fas fa-book-open csrPointer",onClick:function(){window.location.reload()}}),n.a.createElement("h1",{className:"fs14 bold csrPointer",onClick:function(){window.location.reload()}},"longbox")),n.a.createElement("div",{className:"flex alignCenter"},this.state.user.isAdmin&&n.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-edit ".concat(this.state.showAddIssueForm?"":"txtRed"," csrPointer"),onClick:this.toggleShowAddIssueForm}),t)),this.state.showSignInForm&&n.a.createElement(C,{signIn:this.signIn,username:this.state.login.username,password:this.state.login.password,handleLoginChange:this.handleLoginChange}),!this.state.showAddIssueForm&&!this.state.showEditIssueForm&&n.a.createElement("section",{id:"search",className:"mb5"},n.a.createElement("input",{className:"bdrBox bdrBlack p5 wFull",name:"any",onChange:this.handleSearchChange,placeholder:"search by title, publisher, contributor, or notes",value:this.state.search.any})),this.state.showAddIssueForm&&n.a.createElement(E,{handleClose:this.handleAddIssueFormClose,handleContributorTextChange:this.handleContributorTextChange,handleIssueCheckboxChange:this.handleIssueCheckboxChange,handleIssueTextChange:this.handleIssueTextChange,issue:this.state.issue,addIssue:this.addIssue,user:this.state.user}),this.state.showEditIssueForm&&n.a.createElement(f,{handleClose:this.setIssue,handleContributorTextChange:this.handleContributorTextChange,handleIssueCheckboxChange:this.handleIssueCheckboxChange,handleIssueTextChange:this.handleIssueTextChange,issue:this.state.issue,updateIssue:this.updateIssue,user:this.state.user}),!this.state.showAddIssueForm&&!this.state.showEditIssueForm&&n.a.createElement("section",{id:"list",className:"bdrBox mb5 bdrBlack p5"},this.state.issues.length>0?this.state.issues.map(function(t,a){return n.a.createElement("div",{key:a},n.a.createElement("span",{onClick:function(){e.setIssue(t.id)},className:"csrPointer"},a+1,". ",t.title,t.number?" #".concat(t.number):""))}):n.a.createElement("div",null,"...")))}}]),t}(n.a.Component);l.a.render(n.a.createElement(k,null),document.getElementById("root"))}},[[21,1,2]]]);
//# sourceMappingURL=main.ed23a969.chunk.js.map