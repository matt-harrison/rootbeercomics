(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{27:function(e,t,a){e.exports=a(55)},55:function(e,t,a){"use strict";a.r(t);var s=a(0),o=a.n(s),n=a(22),r=a.n(n),i=a(64),l=a(11),c=a(3),m=a(4),h=a(6),d=a(5),p=a(7),u=a(65),f=a(12),g=a.n(f),w=a(23),b=a.n(w),y=function(e){function t(){return Object(c.a)(this,t),Object(h.a)(this,Object(d.a)(t).apply(this,arguments))}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){var e;switch(this.props.itemTypeId){default:case 0:e="film";break;case 1:e="book-open";break;case 2:e="book"}return o.a.createElement("form",{id:"addItemForm",onSubmit:this.props.addItem,className:"flex mb5"},o.a.createElement("div",{className:"mr5 width-4/5"},o.a.createElement("div",{className:"flex"},o.a.createElement("input",{type:"text",name:"title",placeholder:"title",value:this.props.title,onChange:this.props.handleItemChange,className:"mr5 mb5 border-gray p5 width-full"}),o.a.createElement("div",{id:"cycleItemTypeButton",onClick:this.props.cycleItemType,className:"flex justify-center items-center border-gray p5 text-center pointer"},o.a.createElement("i",{"aria-hidden":!0,className:"fas fa-"+e+" pointer"}))),o.a.createElement("div",{className:"flex"},o.a.createElement("div",{id:"date",className:"flex mr5"},o.a.createElement("div",{className:"mr5 width-1/3"},o.a.createElement("input",{type:"text",name:"month",maxLength:"2",placeholder:"month",value:this.props.month,onChange:this.props.handleItemChange,className:"border-gray p5 width-full"})),o.a.createElement("div",{className:"mr5 width-1/3"},o.a.createElement("input",{type:"text",name:"day",maxLength:"2",placeholder:"day",value:this.props.day,onChange:this.props.handleItemChange,className:"border-gray p5 width-full"})),o.a.createElement("div",{className:"width-1/3"},o.a.createElement("input",{type:"text",name:"year",maxLength:"2",placeholder:"year",value:this.props.year,onChange:this.props.handleItemChange,className:"border-gray p5 width-full"}))),o.a.createElement("div",{id:"toggleItemFirstButton",onClick:this.props.toggleItemIsFirst,className:"flex justify-center items-center border-gray p5 lineHieght1 pointer"},this.props.isFirst?"X":""))),o.a.createElement("button",{type:"submit",id:"addItemButton",className:"border-gray p5 width-1/5 pointer"},"add"))}}]),t}(o.a.PureComponent),v=function(){function e(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";if(Object(c.a)(this,e),t.length>=10){var a=t.substr(3,2),s=t.substr(0,2),o=t.substr(6,4);this.iso="".concat(o,"-").concat(s,"-").concat(a),this.year=parseInt(o),this.month=parseInt(s),this.day=parseInt(a)}this.label=t}return Object(m.a)(e,[{key:"equals",value:function(e){return this.year===e.year&&this.month===e.month&&this.day===e.day}},{key:"isGreaterThan",value:function(e){return this.year>e.year||this.year===e.year&&this.month>e.month||this.year===e.year&&this.month===e.month&&this.day>e.day}},{key:"isGreaterThanOrEqualTo",value:function(e){return this.isGreaterThan(e)||this.equals(e)}}]),e}(),k=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],E=[31,28,31,30,31,30,31,31,30,31,30,31],F=["January","February","March","April","May","June","July","August","September","October","November","December"],I=function(e){var t=(new Date).getFullYear(),a=100*parseInt(t.toString().substr(0,2)),s=parseInt(t.toString().substr(2)),o=parseInt(e);return o>s?a-100+o:a+o},x=function(){var e=document.cookie.split("; "),t={isAdmin:!1,isSignedIn:!1,md5:null,name:null};return e.forEach(function(e){var a=e.split("="),s=a[0],o=a[1];"user"===s&&""!==o&&(t=JSON.parse(decodeURIComponent(o)),D("user",JSON.stringify(t)))}),t},N=function(e){return e?"":"text-gray"},C=function(e,t){return 2===e&&t%4===0?29:E[e-1]},S=function(e){return e.toString().padStart(2,"0")},D=function(e,t,a){var s=arguments.length>3&&void 0!==arguments[3]?arguments[3]:"/";"undefined"===typeof a&&(a=new Date).setHours(a.getHours()+24),document.cookie="".concat(e,"=").concat(t,"; expires=").concat(a,"; path=").concat(s)};a.e(3).then(a.t.bind(null,62,7));var M=function(e){function t(){var e,a;Object(c.a)(this,t);for(var s=arguments.length,o=new Array(s),n=0;n<s;n++)o[n]=arguments[n];return(a=Object(h.a)(this,(e=Object(d.a)(t)).call.apply(e,[this].concat(o)))).setDatesToMonth=function(){var e=C(a.props.month,a.props.year),t=S(a.props.month),s=a.props.year,o=new v("".concat(t,"/01/").concat(s)),n=new v("".concat(t,"/").concat(e,"/").concat(s));a.props.setDates(o,n)},a}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){var e=this,t=C(this.props.month,this.props.year),a=new Date(this.props.year,this.props.month-1,1).getDay(),s=(a+t)%7>0?7*(Math.floor((a+t)/7)+1):0,n=[],r=[],i=[],l=[],c=[];this.props.items.forEach(function(t){t.date.year===e.props.year&&t.date.month===e.props.month&&c.push(t)});for(var m=0;m<k.length;m++)n.push(o.a.createElement("div",{className:"day mb5 border-black p5 text-center truncate",key:k[m]},k[m]));for(var h=0;h<a;h++)r.push(o.a.createElement("div",{className:"day mb5 border-gray p5",key:"before".concat(h)}));for(var d=function(t){var a=t+1,s=S(a),n=S(e.props.month),r=e.props.year,i=new v("".concat(n,"/").concat(s,"/").concat(r)),m=c.map(function(e,t){if(e.date.day===a){var s="book";return"comic"===e.type?s="book-open":"movie"===e.type&&(s="film"),o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-".concat(s),key:t})}return null});l.push(o.a.createElement("div",{className:"day mb5 border-black p5 pointer",key:"day".concat(t),onClick:function(){e.props.setDates(i,i)}},o.a.createElement("p",null,t+1),o.a.createElement("p",null,m)))},p=0;p<t;p++)d(p);for(var u=a+t;u<s;u++)i.push(o.a.createElement("div",{className:"day mb5 border-gray p5",key:"after".concat(u)}));return o.a.createElement("section",{id:"calendar"},o.a.createElement("div",{className:"flex justify-between items-center mb5 border-black p5"},o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-chevron-circle-left text-xl desktop-text-l pointer",onClick:this.props.setMonthPrevious}),o.a.createElement("p",{className:"mr5 pointer",onClick:this.setDatesToMonth},F[this.props.month-1]," ",this.props.year),o.a.createElement("i",{"aria-hidden":!0,className:"fas fa-chevron-circle-right text-xl desktop-text-l pointer",onClick:this.props.setMonthNext})),o.a.createElement("div",{className:"flex flex-wrap"},n,r,l,i))}}]),t}(o.a.PureComponent),j=function(e){function t(){return Object(c.a)(this,t),Object(h.a)(this,Object(d.a)(t).apply(this,arguments))}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){var e=this,t=this.props.isAsc?"fa-caret-square-up":"fa-caret-square-down";return o.a.createElement("div",{className:"flex flex-col desktop-flex-row justify-between items-center mb5"},o.a.createElement("div",{className:"flex items-center mr5 mb5 desktop-mb0 width-full desktop-flex1"},o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-book text-xl desktop-text-l ".concat(N(this.props.showBooks)," pointer"),onClick:this.props.toggleShowBooks}),o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-book-open text-xl desktop-text-l ".concat(N(this.props.showComics)," pointer"),onClick:this.props.toggleShowComics}),o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-film text-xl desktop-text-l ".concat(N(this.props.showMovies)," pointer"),onClick:this.props.toggleShowMovies}),o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-calendar text-xl desktop-text-l ".concat(N(this.props.showDate)," pointer"),onClick:this.props.toggleShowDate}),o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-clone text-xl desktop-text-l ".concat(N(this.props.showDuplicates)," pointer"),onClick:this.props.toggleShowDuplicates}),o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas ".concat(t," text-xl desktop-text-l pointer"),onClick:this.props.toggleIsAsc})),o.a.createElement("div",{className:"flex width-full desktop-flex-grow-1"},o.a.createElement("div",{className:"mr5 width-1/3 desktop-width-100"},o.a.createElement("p",{className:"border-black p5 width-full pointer",id:"dateFrom",name:"dateFrom",onClick:function(){e.props.setKeypad(!0,"dateFrom")}},this.props.dateFrom.label||o.a.createElement("span",{className:"text-gray"},"from"))),o.a.createElement("div",{className:"mr5 width-1/3 desktop-width-100"},o.a.createElement("p",{className:"border-black p5 width-full pointer",id:"dateTo",name:"dateTo",onClick:function(){e.props.setKeypad(!0,"dateTo")}},this.props.dateTo.label||o.a.createElement("span",{className:"text-gray"},"to"))),o.a.createElement("div",{className:"width-1/3 desktop-width-100"},o.a.createElement("input",{className:"border-black p5 width-full",name:"title",onChange:this.props.filterTitle,placeholder:"title",value:this.props.title}))))}}]),t}(o.a.PureComponent),O=function(e){function t(){return Object(c.a)(this,t),Object(h.a)(this,Object(d.a)(t).apply(this,arguments))}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){var e=this,t=this.props.itemsFiltered.slice(),a=t.length.toString().length;return this.props.isAsc||t.reverse(),t=(t=t.map(function(s,n){var r,i=e.props.showDate?" (".concat(s.date.label,")"):"",l=e.props.isAsc?n+1:t.length-n,c=s.isFirst?s.title:"[".concat(s.title,"]"),m=l.toString().length,h="".padStart(a-m," ");switch(s.type){default:case"book":r=o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-book"});break;case"comic":r=o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-book-open"});break;case"movie":r=o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-film"})}return o.a.createElement("div",{className:"whitespace-pre",key:n},h,l,". ",r,c,i)})).length>0?t:o.a.createElement("div",null,"..."),o.a.createElement("section",{id:"items",className:"border-black p5"},t)}}]),t}(o.a.PureComponent);a.e(4).then(a.t.bind(null,63,7));var T=function(e){function t(e){var a;Object(c.a)(this,t),(a=Object(h.a)(this,Object(d.a)(t).call(this,e))).addDigit=function(e){var t=a.state.digits.slice();t.push(e.target.textContent);var s=t.length>0?t.join(""):a.state.defaultLabel;6===t.length?a.props.setField(t.join("")):a.setState({digits:t,label:s})},a.clearDigits=function(){a.props.setField(null)},a.removeDigit=function(){var e=a.state.digits.slice(0,a.state.digits.length-1),t=e.length>0?e.join(""):a.state.defaultLabel;a.setState({digits:e,label:t})};var s=o.a.createElement("span",{className:"text-gray"},"mmddyy");return a.state={digits:[],defaultLabel:s,label:s},a}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){return o.a.createElement("div",null,o.a.createElement("div",{className:"absolute full-screen flex justify-center items-center"},o.a.createElement("div",{className:"overlay absolute full-screen bg-white",onClick:this.props.closeModal}),o.a.createElement("div",{className:"keypad absolute border-black p5 bg-white ".concat(this.props.className)},o.a.createElement("p",{className:"mb5 border-black p5 text-center"},this.state.label),o.a.createElement("div",{className:"flex mb5"},o.a.createElement("p",{className:"key mr5 border-black pointer",onClick:this.addDigit},"1"),o.a.createElement("p",{className:"key mr5 border-black pointer",onClick:this.addDigit},"2"),o.a.createElement("p",{className:"key border-black pointer",onClick:this.addDigit},"3")),o.a.createElement("div",{className:"flex mb5"},o.a.createElement("p",{className:"key mr5 border-black pointer",onClick:this.addDigit},"4"),o.a.createElement("p",{className:"key mr5 border-black pointer",onClick:this.addDigit},"5"),o.a.createElement("p",{className:"key border-black pointer",onClick:this.addDigit},"6")),o.a.createElement("div",{className:"flex mb5"},o.a.createElement("p",{className:"key mr5 border-black pointer",onClick:this.addDigit},"7"),o.a.createElement("p",{className:"key mr5 border-black pointer",onClick:this.addDigit},"8"),o.a.createElement("p",{className:"key border-black pointer",onClick:this.addDigit},"9")),o.a.createElement("div",{className:"flex"},o.a.createElement("p",{className:"key mr5 border-black pointer",onClick:this.removeDigit},"<"),o.a.createElement("p",{className:"key mr5 border-black pointer",onClick:this.addDigit},"0"),o.a.createElement("p",{className:"key border-black pointer",onClick:this.clearDigits},"x")))))}}]),t}(o.a.PureComponent),A=function(e){function t(){return Object(c.a)(this,t),Object(h.a)(this,Object(d.a)(t).apply(this,arguments))}return Object(p.a)(t,e),Object(m.a)(t,[{key:"render",value:function(){return o.a.createElement("form",{className:"flex mb5",id:"signInForm",onSubmit:this.props.signIn},o.a.createElement("div",{className:"flex mr5 width-4/5"},o.a.createElement("div",{className:"width-1/2 mr5"},o.a.createElement("input",{className:"border-gray p5 width-full",name:"username",onChange:this.props.handleLoginChange,placeholder:"username",type:"text",value:this.props.username})),o.a.createElement("div",{className:"width-1/2"},o.a.createElement("input",{className:"border-gray p5 width-full",name:"password",onChange:this.props.handleLoginChange,placeholder:"password",type:"password",value:this.props.password}))),o.a.createElement("button",{className:"border-gray p5 width-1/5 pointer",type:"submit"},"sign in"))}}]),t}(o.a.PureComponent);a.e(1).then(a.t.bind(null,60,7)),a.e(2).then(a.t.bind(null,61,7));var Y=function(e){function t(e){var a;Object(c.a)(this,t),(a=Object(h.a)(this,Object(d.a)(t).call(this,e))).addItem=function(e){e.preventDefault();var t={username:a.state.user.name,md5:a.state.user.md5,item:{date:a.state.item.year+"-"+a.state.item.month+"-"+a.state.item.day,isFirst:a.state.item.isFirst,title:a.state.item.title,type:a.state.itemTypes[a.state.itemTypeId]}};g.a.get("https://www.rootbeercomics.com/api/list/insert.php",{params:{data:t}}).then(function(e){if(e.data.success){var t=a.state.item;t.title="",a.setState({item:t}),a.getItems()}})},a.clearDate=function(e){a.setState(Object(l.a)({},e.target.name,new v),a.setItemsFiltered)},a.clearPath=function(){a.setState({calendarMonth:a.state.currentMonth,calendarYear:a.state.currentYear,dateFrom:"",dateTo:"",isAsc:!1,showAddItemForm:!1,showBooks:!0,showCalendar:!1,showComics:!0,showDate:!0,showDuplicates:!0,showFilters:!1,showMovies:!0,showSignInForm:!1,title:""},a.setItemsFiltered)},a.cycleItemType=function(){var e=a.state.itemTypeId+1>=a.state.itemTypes.length?0:a.state.itemTypeId+1;a.setState({itemTypeId:e})},a.filterDate=function(e){var t=e.target.value.match(/\d/g);(t=t?t.slice(0,8).join(""):"").length>4&&(t=t.slice(0,4)+"/"+t.slice(4)),t.length>2&&(t=t.slice(0,2)+"/"+t.slice(2)),a.setState(Object(l.a)({},e.target.name,new v(t)),a.setItemsFiltered)},a.filterItems=function(e){return a.state.dateFrom.iso&&(e=e.filter(function(e){return e.date.isGreaterThanOrEqualTo(a.state.dateFrom)})),a.state.dateTo.iso&&(e=e.filter(function(e){return a.state.dateTo.isGreaterThanOrEqualTo(e.date)})),a.state.showDuplicates||(e=e.filter(function(e){return e.isFirst})),a.state.showBooks||(e=e.filter(function(e){return"book"!==e.type})),a.state.showComics||(e=e.filter(function(e){return"comic"!==e.type})),a.state.showMovies||(e=e.filter(function(e){return"movie"!==e.type})),a.state.title&&(e=e.filter(function(e){return e.title.indexOf(a.state.title)>-1})),e},a.filterTitle=function(e){a.setState({title:e.target.value},a.setItemsFiltered)},a.getHeading=function(){var e="entertainment matt has consumed";return!a.state.showBooks||a.state.showComics||a.state.showMovies?!a.state.showComics||a.state.showBooks||a.state.showMovies?!a.state.showMovies||a.state.showBooks||a.state.showComics?a.state.showBooks&&a.state.showComics&&!a.state.showMovies&&(e="books and comics matt has read"):e="movies matt has seen":e="comics matt has read":e="books matt has read",e},a.getItems=function(){g.a.get("https://www.rootbeercomics.com/api/list/get.php").then(function(e){var t=e.data.items.map(function(e){var t=e.date.substr(0,4),a=e.date.substr(5,2),s=e.date.substr(8,2);return e.isFirst="1"===e.isFirst,e.date=new v("".concat(a,"/").concat(s,"/").concat(t)),e});a.setState({itemsFiltered:a.filterItems(t),items:t})})},a.handleLoginChange=function(e){var t=a.state.login;t[e.target.name]=e.target.value,a.setState({login:t})},a.handleItemChange=function(e){var t=a.state.item;t[e.target.name]=e.target.value,a.setState({item:t})},a.parsePath=function(){var e=window.location.search.substr(1).split("&").filter(function(e){return e}),t={isAsc:!1,dateFrom:new v,dateTo:new v,showBooks:!0,showComics:!0,showDate:!0,showDuplicates:!0,showFilters:e.length>0,showMovies:!0,title:""};return e.forEach(function(e){"asc"===e?t.isAsc=!0:"month:"===e.substr(0,6)?t.calendarMonth=parseInt(e.substr(6)):"year:"===e.substr(0,5)?t.calendarYear=parseInt(e.substr(5)):"calendar"===e?t.showCalendar=!0:"no-books"===e?t.showBooks=!1:"no-comics"===e?t.showComics=!1:"no-date"===e?t.showDate=!1:"no-dupes"===e?t.showDuplicates=!1:"no-movies"===e?t.showMovies=!1:"from:"===e.substr(0,5)?t.dateFrom=new v(e.substr(5)):"to:"===e.substr(0,3)?t.dateTo=new v(e.substr(3)):"title:"===e.substr(0,6)&&(t.title=e.substr(6))}),t},a.setDates=function(e,t){a.setState({dateFrom:e,dateTo:t,showFilters:!0},a.setItemsFiltered)},a.setField=function(e){var t=a.state.keypadField;if(e){var s,o=e.substr(2,2),n=e.substr(0,2),r=I(e.substr(4,2)),i=new v("".concat(n,"/").concat(o,"/").concat(r));a.setState((s={},Object(l.a)(s,t,i),Object(l.a)(s,"showCalendar",!1),Object(l.a)(s,"showKeypad",!1),s),a.setItemsFiltered)}else{var c;a.setState((c={},Object(l.a)(c,t,new v),Object(l.a)(c,"showKeypad",!1),c),a.setItemsFiltered)}},a.setItemsFiltered=function(){var e=a.state.items.slice();a.setPath(),a.setState({itemsFiltered:a.filterItems(e)})},a.setKeypad=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;e?document.body.classList.add("overflow-hidden"):document.body.classList.remove("overflow-hidden"),a.setState({keypadField:t,showKeypad:e})},a.setMonthNext=function(){var e=12===a.state.calendarMonth?1:a.state.calendarMonth+1,t=12===a.state.calendarMonth?a.state.calendarYear+1:a.state.calendarYear,s=C(e,t),o=S(e),n=new v("".concat(o,"/01/").concat(t)),r=new v("".concat(o,"/").concat(s,"/").concat(t));a.setState({calendarMonth:e,calendarYear:t,dateFrom:n,dateTo:r},a.setItemsFiltered)},a.setMonthPrevious=function(){var e=1===a.state.calendarMonth?12:a.state.calendarMonth-1,t=1===a.state.calendarMonth?a.state.calendarYear-1:a.state.calendarYear,s=C(e,t),o=S(e),n=new v("".concat(o,"/01/").concat(t)),r=new v("".concat(o,"/").concat(s,"/").concat(t));a.setState({calendarMonth:e,calendarYear:t,dateFrom:n,dateTo:r},a.setItemsFiltered)},a.setPath=function(){var e=[];a.state.isAsc&&e.push("asc"),a.state.showCalendar&&e.push("calendar"),a.state.calendarMonth!==a.state.currentMonth&&e.push("month:".concat(a.state.calendarMonth)),a.state.calendarYear!==a.state.currentYear&&e.push("year:".concat(a.state.calendarYear)),a.state.dateFrom.iso&&e.push("from:"+a.state.dateFrom.label),a.state.dateTo.iso&&e.push("to:"+a.state.dateTo.label),a.state.showBooks||e.push("no-books"),a.state.showComics||e.push("no-comics"),a.state.showMovies||e.push("no-movies"),a.state.showDate||e.push("no-date"),a.state.showDuplicates||e.push("no-dupes"),""!==a.state.title&&e.push("title:"+a.state.title),a.props.history.push("?"+e.join("&"))},a.signIn=function(e){e.preventDefault();var t=b()(a.state.login.username+a.state.login.password),s={username:a.state.login.username,md5:t};g.a.get("https://www.rootbeercomics.com/login/ajax/index.php",{params:s}).then(function(e){if(e.data.success){var t={isAdmin:"matt!"===s.username,isSignedIn:!0,md5:s.md5,name:s.username};a.setState({showSignInForm:!1,user:t}),D("user",JSON.stringify(a.state.user))}else{var o={username:a.state.login.username,password:""};a.setState({input:o})}})},a.signOut=function(){if(window.confirm("sign out?")){var e={isAdmin:!1,isSignedIn:!1,md5:"",name:""};g.a.get("https://www.rootbeercomics.com/login/ajax/log-out.php").then(function(t){a.setState({showAddItemForm:!1,user:e}),D("user","")})}},a.toggleFilter=function(){var e=!a.state.showFilters;a.setState({showFilters:e})},a.toggleIsAsc=function(){var e=!a.state.isAsc;a.setState({isAsc:e},a.setPath)},a.toggleItemIsFirst=function(){var e=a.state.item;e.isFirst=!e.isFirst,a.setState({item:e})},a.toggleShowAddItemForm=function(){var e=!a.state.showAddItemForm;a.setState({showAddItemForm:e})},a.toggleShowBooks=function(){var e=!a.state.showBooks;a.setState({showBooks:e},a.setItemsFiltered)},a.toggleShowCalendar=function(){var e=!a.state.showCalendar,t=a.state.currentMonth,s=a.state.currentYear,o=new v,n=new v;if(e){var r=S(t),i=C(t,s);o=new v("".concat(r,"/01/").concat(s)),n=new v("".concat(r,"/").concat(i,"/").concat(s))}a.setState({calendarMonth:t,calendarYear:s,dateFrom:o,dateTo:n,showCalendar:e,showFilters:!!e||!e},a.setItemsFiltered)},a.toggleShowComics=function(){var e=!a.state.showComics;a.setState({showComics:e},a.setItemsFiltered)},a.toggleShowDate=function(){var e=!a.state.showDate;a.setState({showDate:e},a.setItemsFiltered)},a.toggleShowDuplicates=function(){var e=!a.state.showDuplicates;a.setState({showDuplicates:e},a.setItemsFiltered)},a.toggleShowMovies=function(){var e=!a.state.showMovies;a.setState({showMovies:e},a.setItemsFiltered)},a.toggleShowSignInForm=function(){var e=!a.state.showSignInForm;a.setState({showSignInForm:e})};var s=a.parsePath(),o=new Date,n=o.getMonth()+1;if(s.showCalendar&&!s.dateFrom.iso&&!s.dateTo.iso){var r=s.calendarMonth?S(s.calendarMonth):S(n),i=s.calendarYear?s.calendarYear:o.getFullYear(),m=C(n,i);s.dateFrom=new v("".concat(r,"/01/").concat(i)),s.dateTo=new v("".concat(r,"/").concat(m,"/").concat(i))}return a.state={calendarMonth:s.calendarMonth||n,calendarYear:s.calendarYear||o.getFullYear(),currentMonth:n,currentYear:o.getFullYear(),dateFrom:s.dateFrom,dateTo:s.dateTo,isAsc:s.isAsc,item:{day:S(o.getDate()),isFirst:!0,month:S(n),title:"",type:"movie",year:o.getFullYear()},items:[],itemsFiltered:[],itemTypeId:0,itemTypes:["movie","comic","book"],login:{username:"",password:""},showAddItemForm:!1,showBooks:s.showBooks,showCalendar:s.showCalendar,showComics:s.showComics,showDate:s.showDate,showDuplicates:s.showDuplicates,showFilters:s.showFilters,showKeypad:!1,showMovies:s.showMovies,showSignInForm:!1,today:o,title:s.title,user:x()},a}return Object(p.a)(t,e),Object(m.a)(t,[{key:"componentDidMount",value:function(){this.getItems()}},{key:"render",value:function(){var e=this;return o.a.createElement("div",{className:"mx-auto width-600"},o.a.createElement("div",{className:"flex justify-between items-center mb5"},o.a.createElement("div",{className:"flex items-center mr5 bold"},o.a.createElement("i",{"aria-hidden":!0,className:"mr10 fas fa-list-ul text-xl desktop-text-l pointer",onClick:this.clearPath}),o.a.createElement("h1",{className:"text-l bold pointer",onClick:this.clearPath},this.getHeading())),o.a.createElement("div",{className:"flex"},this.state.user.isAdmin?o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-edit ".concat(N(this.state.showAddItemForm)," text-xl desktop-text-l pointer"),onClick:this.toggleShowAddItemForm}):null,o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-calendar-alt ".concat(N(this.state.showCalendar)," text-xl desktop-text-l pointer"),onClick:this.toggleShowCalendar}),o.a.createElement("i",{"aria-hidden":!0,className:"mr5 fas fa-filter ".concat(N(this.state.showFilters)," text-xl desktop-text-l pointer"),onClick:this.toggleFilter}),this.state.user.isSignedIn?o.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-out-alt text-xl desktop-text-l pointer",onClick:this.signOut}):o.a.createElement("i",{"aria-hidden":!0,className:"fas fa-sign-in-alt text-xl desktop-text-l pointer",onClick:this.toggleShowSignInForm}))),this.state.user.isSignedIn&&this.state.showAddItemForm&&o.a.createElement(y,{addItem:this.addItem,cycleItemType:this.cycleItemType,day:this.state.item.day,isFirst:this.state.item.isFirst,itemTypeId:this.state.itemTypeId,handleItemChange:this.handleItemChange,month:this.state.item.month,title:this.state.item.title,toggleItemIsFirst:this.toggleItemIsFirst,year:this.state.item.year}),this.state.showSignInForm&&o.a.createElement(A,{signIn:this.signIn,username:this.state.login.username,password:this.state.login.password,handleLoginChange:this.handleLoginChange}),this.state.showFilters&&o.a.createElement(j,{dateFrom:this.state.dateFrom,dateTo:this.state.dateTo,filterTitle:this.filterTitle,isAsc:this.state.isAsc,params:this.state.params,setKeypad:this.setKeypad,showBooks:this.state.showBooks,showDate:this.state.showDate,showDuplicates:this.state.showDuplicates,showComics:this.state.showComics,showMovies:this.state.showMovies,title:this.state.title,toggleIsAsc:this.toggleIsAsc,toggleShowBooks:this.toggleShowBooks,toggleShowComics:this.toggleShowComics,toggleShowDuplicates:this.toggleShowDuplicates,toggleShowMovies:this.toggleShowMovies,toggleShowDate:this.toggleShowDate}),this.state.showCalendar&&o.a.createElement(M,{items:this.state.itemsFiltered,month:this.state.calendarMonth,setDates:this.setDates,setMonthNext:this.setMonthNext,setMonthPrevious:this.setMonthPrevious,year:this.state.calendarYear}),o.a.createElement(O,{isAsc:this.state.isAsc,itemsFiltered:this.state.itemsFiltered,showDate:this.state.showDate}),this.state.showKeypad&&o.a.createElement(T,{closeModal:function(){e.setKeypad(!1)},setField:this.setField}))}}]),t}(o.a.Component),B=Object(u.a)(Y);r.a.render(o.a.createElement(i.a,null,o.a.createElement(B,null)),document.getElementById("root"))}},[[27,6,5]]]);
//# sourceMappingURL=main.7b8e18b9.chunk.js.map