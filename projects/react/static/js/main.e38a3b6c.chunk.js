(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{26:function(e,t,s){e.exports=s(56)},54:function(e,t,s){},56:function(e,t,s){"use strict";s.r(t);var a=s(0),i=s.n(a),o=s(20),n=s.n(o),r=s(58),l=s(21),c=s(3),m=s(4),h=s(6),d=s(5),p=s(7),u=s(59),f=s(9),g=s.n(f),w=s(22),v=s.n(w),b=function(e){function t(){return Object(c.a)(this,t),Object(h.a)(this,Object(d.a)(t).apply(this,arguments))}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){var e;switch(this.props.itemTypeId){default:case 0:e="film";break;case 1:e="book-open";break;case 2:e="book"}return i.a.createElement("form",{id:"addItemForm",onSubmit:this.props.addItem,className:"flex mb5"},i.a.createElement("div",{className:"bdrBox mr5 flex80"},i.a.createElement("div",{className:"flex"},i.a.createElement("input",{type:"text",name:"title",placeholder:"title",value:this.props.title,onChange:this.props.handleItemChange,className:"bdrBox mr5 mb5 bdrGray p5 flex100"}),i.a.createElement("div",{id:"cycleItemTypeButton",onClick:this.props.cycleItemType,className:"flex justifyCenter alignCenter bdrBox bdrGray p5 txtC csrPointer"},i.a.createElement("i",{"aria-hidden":!0,className:"fas fa-"+e+" csrPointer"}))),i.a.createElement("div",{className:"flex"},i.a.createElement("div",{id:"date",className:"flex mr5"},i.a.createElement("div",{className:"mr5 flex33"},i.a.createElement("input",{type:"text",name:"month",maxLength:"2",placeholder:"month",value:this.props.month,onChange:this.props.handleItemChange,className:"bdrBox bdrGray p5 flex100"})),i.a.createElement("div",{className:"mr5 flex33"},i.a.createElement("input",{type:"text",name:"day",maxLength:"2",placeholder:"day",value:this.props.day,onChange:this.props.handleItemChange,className:"bdrBox bdrGray p5 flex100"})),i.a.createElement("div",{className:"flex33"},i.a.createElement("input",{type:"text",name:"year",maxLength:"2",placeholder:"year",value:this.props.year,onChange:this.props.handleItemChange,className:"bdrBox bdrGray p5 flex100"}))),i.a.createElement("div",{id:"toggleItemFirstButton",onClick:this.props.toggleItemIsFirst,className:"flex justifyCenter alignCenter bdrBox bdrGray p5 lineHieght1 csrPointer"},this.props.isFirst?"X":""))),i.a.createElement("button",{type:"submit",id:"addItemButton",className:"bdrBox bdrGray p5 flex20 csrPointer"},"add"))}}]),t}(i.a.PureComponent),S=function(e){function t(){return Object(c.a)(this,t),Object(h.a)(this,Object(d.a)(t).apply(this,arguments))}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){var e=this.props.isAsc?"fa-caret-square-up":"fa-caret-square-down",t=this.props.showBooks?"":"txtRed",s=this.props.showComics?"":"txtRed",a=this.props.showMovies?"":"txtRed",o=this.props.showDate?"":"txtRed",n=this.props.showDuplicates?"":"txtRed";return i.a.createElement("div",{className:"flex flex-col m-flex-row spaceBetween alignCenter mb5 fs14"},i.a.createElement("div",{className:"flex alignCenter mr5 mb5 m-mb0 flex100 m-flex1"},i.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas ".concat(e," csrPointer"),onClick:this.props.toggleIsAsc}),i.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas ".concat(t," fa-book csrPointer"),onClick:this.props.toggleShowBooks}),i.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas ".concat(s," fa-book-open csrPointer"),onClick:this.props.toggleShowComics}),i.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas ".concat(a," fa-film csrPointer"),onClick:this.props.toggleShowMovies}),i.a.createElement("i",{"aria-hidden":!0,className:"mr5 far ".concat(o," fa-calendar csrPointer"),onClick:this.props.toggleShowDate}),i.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas ".concat(n," fa-clone csrPointer"),onClick:this.props.toggleShowDuplicates})),i.a.createElement("div",{className:"flex flex100 m-flex1"},i.a.createElement("div",{className:"mr5 flex33 m-w100"},i.a.createElement("input",{className:"bdrBox bdrGray p5 flex100",id:"dateStart",name:"dateStart",onChange:this.props.filterDate,placeholder:"from: mmddyy",value:this.props.dateStart})),i.a.createElement("div",{className:"mr5 flex33 m-w100"},i.a.createElement("input",{className:"bdrBox bdrGray p5 flex100",id:"dateEnd",name:"dateEnd",onChange:this.props.filterDate,placeholder:"to: mmddyy",value:this.props.dateEnd})),i.a.createElement("div",{className:"flex33 m-w100"},i.a.createElement("input",{className:"bdrBox bdrGray p5 flex100",name:"title",onChange:this.props.filterTitle,placeholder:"title",value:this.props.title}))))}}]),t}(i.a.PureComponent),y=function(e){function t(){return Object(c.a)(this,t),Object(h.a)(this,Object(d.a)(t).apply(this,arguments))}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){var e,t=this;if(this.props.items){if(e=this.props.items.slice(),this.props.isAsc||e.reverse(),this.props.title&&(e=e.filter(function(e){return e.title.indexOf(t.props.title)>-1})),8===this.props.dateStart.length){var s=new Date(this.props.dateStart);e=e.filter(function(e){return new Date(e.date.substr(0,10))>=s})}if(8===this.props.dateEnd.length){var a=new Date(this.props.dateEnd);e=e.filter(function(e){return new Date(e.date.substr(0,10))<=a})}this.props.showDuplicates||(e=e.filter(function(e){return e.isFirst})),this.props.showBooks||(e=e.filter(function(e){return"book"!==e.type})),this.props.showComics||(e=e.filter(function(e){return"comic"!==e.type})),this.props.showMovies||(e=e.filter(function(e){return"movie"!==e.type})),e=(e=e.map(function(s,a){var o=new Date(s.date.replace(" ","T"));o.setHours(o.getHours()+5);var n,r=(o.getMonth()+1).toString().padStart(2,"0"),l=o.getDate().toString().padStart(2,"0"),c=o.getFullYear().toString().substr(2),m=s.isFirst?s.title:"[".concat(s.title,"]"),h=t.props.isAsc?a+1:e.length-a,d=t.props.showDate?" (".concat(r,"/").concat(l,"/").concat(c,")"):"";switch(s.type){default:case"book":n=i.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-book"});break;case"comic":n=i.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-book-open"});break;case"movie":n=i.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-film"})}return i.a.createElement("div",{key:a},h,". ",n,m,d)})).length>0?e:i.a.createElement("div",null,"...")}return i.a.createElement("div",{id:"items",className:"bdrBox bdrGray p5"},e)}}]),t}(i.a.PureComponent),E=function(e){function t(){return Object(c.a)(this,t),Object(h.a)(this,Object(d.a)(t).apply(this,arguments))}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){return i.a.createElement("form",{id:"signInForm",onSubmit:this.props.signIn,className:"flex mb5"},i.a.createElement("div",{className:"flex bdrBox mr5 flex80"},i.a.createElement("div",{className:"mr5 flex50"},i.a.createElement("input",{type:"text",name:"username",placeholder:"username",value:this.props.username,onChange:this.props.handleInputChange,className:"bdrBox bdrGray p5 flex100"})),i.a.createElement("div",{className:"flex50"},i.a.createElement("input",{type:"password",name:"password",placeholder:"password",value:this.props.password,onChange:this.props.handleInputChange,className:"bdrBox bdrGray p5 flex100"}))),i.a.createElement("button",{type:"submit",className:"bdrBox bdrGray p5 flex20 csrPointer"},"sign in"))}}]),t}(i.a.PureComponent),x=function(e){function t(e){var s;Object(c.a)(this,t),(s=Object(h.a)(this,Object(d.a)(t).call(this,e))).addItem=function(e){e.preventDefault();var t={username:s.state.user.name,md5:s.state.user.md5,item:{date:s.state.item.year+"-"+s.state.item.month+"-"+s.state.item.day,isFirst:s.state.item.isFirst,title:s.state.item.title,type:s.state.itemTypes[s.state.itemTypeId]}};g.a.get("https://www.rootbeercomics.com/projects/list/insert.php",{params:{data:t}}).then(function(e){if(e.data.success){var t=s.state.item;t.title="",s.setState({item:t}),s.getItems()}})},s.cycleItemType=function(){var e=s.state.itemTypeId+1>=s.state.itemTypes.length?0:s.state.itemTypeId+1;s.setState({itemTypeId:e})},s.filterDate=function(e){var t=e.target.value.match(/\d/g);(t=t?t.slice(0,6).join(""):"").length>4&&(t=t.slice(0,4)+"/"+t.slice(4)),t.length>2&&(t=t.slice(0,2)+"/"+t.slice(2)),s.setState(Object(l.a)({},e.target.name,t),s.updatePath)},s.filterTitle=function(e){s.setState({title:e.target.value},s.updatePath)},s.getCookie=function(){var e=document.cookie.split("; "),t={isAdmin:!1,isSignedIn:!1,md5:null,name:null};return e.forEach(function(e){var s=e.split("="),a=s[0],i=s[1];"user"===a&&""!==i&&(t=JSON.parse(decodeURIComponent(i)))}),t},s.getHeading=function(){var e="entertainment matt has consumed";return!s.state.showBooks||s.state.showComics||s.state.showMovies?!s.state.showComics||s.state.showBooks||s.state.showMovies?!s.state.showMovies||s.state.showBooks||s.state.showComics?s.state.showBooks&&s.state.showComics&&!s.state.showMovies&&(e="books and comics matt has read"):e="movies matt has seen":e="comics matt has read":e="books matt has read",e},s.getItems=function(){g.a.get("https://www.rootbeercomics.com/projects/list/get.php").then(function(e){var t=e.data.items.map(function(e){return e.isFirst="1"===e.isFirst,e});s.setState({items:t})})},s.handleInputChange=function(e){var t=s.state.input;t[e.target.name]=e.target.value,s.setState({input:t})},s.handleItemChange=function(e){var t=s.state.item;t[e.target.name]=e.target.value,s.setState({item:t})},s.parsePath=function(){var e=window.location.search.substr(1).split("&").filter(function(e){return e}),t={isAsc:!1,dateStart:"",dateEnd:"",showBooks:!0,showComics:!0,showDate:!0,showDuplicates:!0,showFilters:e.length>0,showMovies:!0,title:""};return e.forEach(function(e){if("asc"===e)t.isAsc=!0;else if("no-books"===e)t.showBooks=!1;else if("no-comics"===e)t.showComics=!1;else if("no-date"===e)t.showDate=!1;else if("no-dupes"===e)t.showDuplicates=!1;else if("no-movies"===e)t.showMovies=!1;else if("start:"===e.substr(0,6)){var s=e.substr(6).replace(/\./g,"/");t.dateStart=s}else if("end:"===e.substr(0,4)){var a=e.substr(4).replace(/\./g,"/");t.dateEnd=a}else"title:"===e.substr(0,6)&&(t.title=e.substr(6))}),t},s.setCookie=function(e,t,s){var a=arguments.length>3&&void 0!==arguments[3]?arguments[3]:"/";"undefined"===typeof s&&(s=new Date).setHours(s.getHours()+24),document.cookie="".concat(e,"=").concat(t,"; expires=").concat(s,"; path=").concat(a)},s.signIn=function(e){e.preventDefault();var t=v()(s.state.input.username+s.state.input.password),a={username:s.state.input.username,md5:t};g.a.get("https://www.rootbeercomics.com/login/ajax/index.php",{params:a}).then(function(e){if(e.data.success){var t={isAdmin:"matt!"===a.username,isSignedIn:!0,md5:a.md5,name:a.username};s.setState({showSignInForm:!1,user:t}),s.setCookie("user",JSON.stringify(s.state.user))}else{var i={username:s.state.input.username,password:""};s.setState({input:i})}})},s.signOut=function(){var e={isAdmin:!1,isSignedIn:!1,md5:"",name:""};g.a.get("https://www.rootbeercomics.com/login/ajax/log-out.php").then(function(t){s.setState({showAddItemForm:!1,user:e}),s.setCookie("user","")})},s.toggleItemIsFirst=function(){var e=s.state.item;e.isFirst=!e.isFirst,s.setState({item:e})},s.toggleShowAddItemForm=function(){s.setState({showAddItemForm:!s.state.showAddItemForm})},s.toggleFilter=function(){var e=!s.state.showFilters;s.setState({showFilters:e})},s.toggleIsAsc=function(){s.setState({isAsc:!s.state.isAsc},s.updatePath)},s.toggleShowBooks=function(){s.setState({showBooks:!s.state.showBooks},s.updatePath)},s.toggleShowComics=function(){s.setState({showComics:!s.state.showComics},s.updatePath)},s.toggleShowDate=function(){s.setState({showDate:!s.state.showDate},s.updatePath)},s.toggleShowDuplicates=function(){s.setState({showDuplicates:!s.state.showDuplicates},s.updatePath)},s.toggleShowMovies=function(){s.setState({showMovies:!s.state.showMovies},s.updatePath)},s.toggleShowSignInForm=function(){s.setState({showSignInForm:!s.state.showSignInForm})},s.updatePath=function(){var e=[];if(s.state.isAsc&&e.push("asc"),s.state.showBooks||e.push("no-books"),s.state.showComics||e.push("no-comics"),s.state.showMovies||e.push("no-movies"),s.state.showDate||e.push("no-date"),s.state.showDuplicates||e.push("no-dupes"),8===s.state.dateStart.length){var t=s.state.dateStart.replace(/[\/-]/g,".");e.push("start:"+t)}if(8===s.state.dateEnd.length){var a=s.state.dateEnd.replace(/[\/-]/g,".");e.push("end:"+a)}""!==s.state.title&&e.push("title:"+s.state.title),s.props.history.push("?"+e.join("&"))};var a=s.parsePath(),i=new Date;return s.state={dateEnd:a.dateEnd||"",dateStart:a.dateStart||"",input:{username:"",password:""},isAsc:a.isAsc||!1,item:{day:i.getDate().toString().padStart(2,"0"),isFirst:!0,month:(i.getMonth()+1).toString().padStart(2,"0"),title:"",type:"movie",year:i.getFullYear().toString().substr(2)},items:[],itemTypeId:0,itemTypes:["movie","comic","book"],showAddItemForm:!1,showBooks:a.showBooks,showComics:a.showComics,showDate:a.showDate,showDuplicates:a.showDuplicates,showFilters:a.showFilters,showMovies:a.showMovies,showSignInForm:!1,title:a.title,user:s.getCookie()},s}return Object(p.a)(t,e),Object(m.a)(t,[{key:"componentDidMount",value:function(){this.getItems()}},{key:"render",value:function(){var e=this.getHeading(),t=this.state.user.isAdmin?i.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-edit csrPointer",onClick:this.toggleShowAddItemForm}):null,s=this.state.user.isSignedIn?i.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-out-alt csrPointer",onClick:this.signOut}):i.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-in-alt csrPointer",onClick:this.toggleShowSignInForm});return i.a.createElement("div",{className:"mAuto w600"},i.a.createElement("div",{className:"flex spaceBetween alignCenter mb5 fs14"},i.a.createElement("p",{className:"mr5 bold"},e),i.a.createElement("div",{className:"flex"},t,i.a.createElement("i",{className:"mr5 fas fa-filter csrPointer",onClick:this.toggleFilter}),i.a.createElement("a",{className:"mr5",href:"https://www.rootbeercomics.com/projects/list/calendar",rel:"noopener noreferrer",target:"_blank"},i.a.createElement("i",{"aria-hidden":!0,className:"txtBlack fas fa-calendar csrPointer"})),s)),this.state.user.isSignedIn&&this.state.showAddItemForm&&i.a.createElement(b,{addItem:this.addItem,cycleItemType:this.cycleItemType,day:this.state.item.day,isFirst:this.state.item.isFirst,itemTypeId:this.state.itemTypeId,handleItemChange:this.handleItemChange,month:this.state.item.month,title:this.state.item.title,toggleItemIsFirst:this.toggleItemIsFirst,year:this.state.item.year}),this.state.showSignInForm&&i.a.createElement(E,{signIn:this.signIn,username:this.state.input.username,password:this.state.input.password,handleInputChange:this.handleInputChange}),this.state.showFilters&&i.a.createElement(S,{dateEnd:this.state.dateEnd,dateStart:this.state.dateStart,filterDate:this.filterDate,filterTitle:this.filterTitle,isAsc:this.state.isAsc,showBooks:this.state.showBooks,showComics:this.state.showComics,showDate:this.state.showDate,showDuplicates:this.state.showDuplicates,showMovies:this.state.showMovies,toggleIsAsc:this.toggleIsAsc,toggleShowBooks:this.toggleShowBooks,toggleShowComics:this.toggleShowComics,toggleShowDuplicates:this.toggleShowDuplicates,toggleShowMovies:this.toggleShowMovies,toggleShowDate:this.toggleShowDate,title:this.state.title}),i.a.createElement(y,{isAsc:this.state.isAsc,items:this.state.items,dateEnd:this.state.dateEnd,dateStart:this.state.dateStart,showBooks:this.state.showBooks,showDate:this.state.showDate,showDuplicates:this.state.showDuplicates,showComics:this.state.showComics,showMovies:this.state.showMovies,title:this.state.title}))}}]),t}(a.Component),C=Object(u.a)(x);s(54);n.a.render(i.a.createElement(r.a,null,i.a.createElement(C,null)),document.getElementById("root"))}},[[26,2,1]]]);
//# sourceMappingURL=main.e38a3b6c.chunk.js.map