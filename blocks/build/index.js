(window.webpackJsonp_blocks=window.webpackJsonp_blocks||[]).push([[1],[,function(e,t,l){},function(e,t,l){}]]),function(e){function t(t){for(var r,n,s=t[0],o=t[1],i=t[2],b=0,p=[];b<s.length;b++)n=s[b],Object.prototype.hasOwnProperty.call(a,n)&&a[n]&&p.push(a[n][0]),a[n]=0;for(r in o)Object.prototype.hasOwnProperty.call(o,r)&&(e[r]=o[r]);for(u&&u(t);p.length;)p.shift()();return c.push.apply(c,i||[]),l()}function l(){for(var e,t=0;t<c.length;t++){for(var l=c[t],r=!0,s=1;s<l.length;s++){var o=l[s];0!==a[o]&&(r=!1)}r&&(c.splice(t--,1),e=n(n.s=l[0]))}return e}var r={},a={0:0},c=[];function n(t){if(r[t])return r[t].exports;var l=r[t]={i:t,l:!1,exports:{}};return e[t].call(l.exports,l,l.exports,n),l.l=!0,l.exports}n.m=e,n.c=r,n.d=function(e,t,l){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:l})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var l=Object.create(null);if(n.r(l),Object.defineProperty(l,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(l,r,function(t){return e[t]}.bind(null,r));return l},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="";var s=window.webpackJsonp_blocks=window.webpackJsonp_blocks||[],o=s.push.bind(s);s.push=t,s=s.slice();for(var i=0;i<s.length;i++)t(s[i]);var u=o;c.push([3,1]),l()}([function(e,t){e.exports=window.wp.element},,,function(e,t,l){"use strict";l.r(t);var r=l(0);l(1);const{__:__}=wp.i18n,{Fragment:a,Component:c}=wp.element,{createBlock:n,registerBlockType:s}=wp.blocks,{RichText:o,PlainText:i,InspectorControls:u}=wp.blockEditor,{PanelBody:b,ToggleControl:p,SelectControl:m,TextControl:g}=wp.components;function d({value:e}){let t,l,c,n,s;switch(e){case"0":t="grey-star",l="grey-star",c="grey-star",n="grey-star",s="grey-star";break;case"1":t="gold-star",l="grey-star",c="grey-star",n="grey-star",s="grey-star";break;case"2":t="gold-star",l="gold-star",c="grey-star",n="grey-star",s="grey-star";break;case"3":t="gold-star",l="gold-star",c="gold-star",n="grey-star",s="grey-star";break;case"4":t="gold-star",l="gold-star",c="gold-star",n="gold-star",s="grey-star";break;case"5":t="gold-star",l="gold-star",c="gold-star",n="gold-star",s="gold-star";break;default:t="red-star",l="red-star",c="red-star",n="red-star",s="red-star"}return Object(r.createElement)(a,null,Object(r.createElement)("svg",{version:"1.1",id:""+t,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 475.075 475.075"},Object(r.createElement)("g",null,Object(r.createElement)("path",{d:"M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"}))),Object(r.createElement)("svg",{version:"1.1",id:""+l,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 475.075 475.075"},Object(r.createElement)("g",null,Object(r.createElement)("path",{d:"M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"}))),Object(r.createElement)("svg",{version:"1.1",id:""+c,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 475.075 475.075"},Object(r.createElement)("g",null,Object(r.createElement)("path",{d:"M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"}))),Object(r.createElement)("svg",{version:"1.1",id:""+n,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 475.075 475.075"},Object(r.createElement)("g",null,Object(r.createElement)("path",{d:"M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"}))),Object(r.createElement)("svg",{version:"1.1",id:""+s,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 475.075 475.075"},Object(r.createElement)("g",null,Object(r.createElement)("path",{d:"M475.075,186.573c0-7.043-5.328-11.42-15.992-13.135L315.766,152.6L251.529,22.694c-3.614-7.804-8.281-11.704-13.99-11.704 c-5.708,0-10.372,3.9-13.989,11.704L159.31,152.6L15.986,173.438C5.33,175.153,0,179.53,0,186.573c0,3.999,2.38,8.567,7.139,13.706 l103.924,101.068L86.51,444.096c-0.381,2.666-0.57,4.575-0.57,5.712c0,3.997,0.998,7.374,2.996,10.136 c1.997,2.766,4.993,4.142,8.992,4.142c3.428,0,7.233-1.137,11.42-3.423l128.188-67.386l128.194,67.379 c4,2.286,7.806,3.43,11.416,3.43c7.812,0,11.714-4.75,11.714-14.271c0-2.471-0.096-4.374-0.287-5.716l-24.551-142.744 l103.634-101.069C472.604,195.33,475.075,190.76,475.075,186.573z M324.619,288.5l20.551,120.2l-107.634-56.821L129.614,408.7 l20.843-120.2l-87.365-84.799l120.484-17.7l53.959-109.064l53.957,109.064l120.494,17.7L324.619,288.5z"}))))}function f({link:e}){if(e)return Object(r.createElement)("a",{href:""+e,class:"btn btn-primary"},"Full Recap")}function v({link:e,count:t}){return e&&t?Object(r.createElement)("a",{href:e,class:"btn btn-primary"},"Screenshots (",t," images)"):e&&!t?Object(r.createElement)("a",{href:e,class:"btn btn-primary"},"Screenshots"):void 0}s("flfblocks/recap",{apiVersion:2,title:__("Grade"),icon:Object(r.createElement)("svg",{"aria-hidden":"true","data-prefix":"far","data-icon":"star-exclamation",role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 576 512",class:"svg-inline--fa fa-star-exclamation fa-w-18 fa-3x"},Object(r.createElement)("path",{fill:"currentColor",d:"M252.5 184.6c-.4-4.6 3.3-8.6 8-8.6h55.1c4.7 0 8.3 4 8 8.6l-6.8 88c-.3 4.2-3.8 7.4-8 7.4h-41.5c-4.2 0-7.7-3.2-8-7.4l-6.8-88zM288 296c-22.1 0-40 17.9-40 40s17.9 40 40 40 40-17.9 40-40-17.9-40-40-40zm257.9-70L440.1 329l25 145.5c4.5 26.2-23.1 46-46.4 33.7L288 439.6l-130.7 68.7c-23.4 12.3-50.9-7.6-46.4-33.7l25-145.5L30.1 226c-19-18.5-8.5-50.8 17.7-54.6L194 150.2l65.3-132.4c11.8-23.8 45.7-23.7 57.4 0L382 150.2l146.1 21.2c26.2 3.8 36.7 36.1 17.8 54.6zm-56.8-11.7l-139-20.2-62.1-126L225.8 194l-139 20.2 100.6 98-23.7 138.4L288 385.3l124.3 65.4-23.7-138.4 100.5-98z",class:""})),category:"flfblocks",keywords:[__("recap"),__("review")],customClassName:!1,className:!0,attributes:{summary:{type:"string"},stars:{type:"string",default:"3"},recaplink:{type:"string",default:"https://jorjafox.net/library/"},gallerylink:{type:"string"},gallerycount:{type:"string"}},edit:e=>{const{attributes:{placeholder:t},className:l,setAttributes:c}=e,{summary:n,stars:s,recaplink:i,gallerylink:p,gallerycount:f}=e.attributes;return Object(r.createElement)(a,null,Object(r.createElement)(u,null,Object(r.createElement)(b,{title:"Recap Block Settings"},Object(r.createElement)(m,{label:"Stars",value:s,options:[{label:"Stars ... (5 is best, 0 is mentioned only)",value:null},{label:"0",value:"0"},{label:"1",value:"1"},{label:"2",value:"2"},{label:"3",value:"3"},{label:"4",value:"4"},{label:"5",value:"5"}],onChange:t=>e.setAttributes({stars:t})}),Object(r.createElement)(g,{label:"Recap Link",help:"Link to full recap.",onChange:e=>c({recaplink:e}),value:i}),Object(r.createElement)(g,{label:"Gallery Link",help:"Link to full recap.",onChange:e=>c({gallerylink:e}),value:p}),Object(r.createElement)(g,{label:"Gallery Count",help:"Number of items in the gallery",onChange:e=>c({gallerycount:e}),value:f}))),Object(r.createElement)("div",{className:l+" flf-recap card w-75"},Object(r.createElement)("div",{class:"card-body"},Object(r.createElement)("div",{class:"flf-rating"},Object(r.createElement)(d,{value:s})),Object(r.createElement)(o,{tagName:"p",class:"card-text",value:n,placeholder:"Summary (could have been better...)",onChange:e=>c({summary:e})}),Object(r.createElement)("a",{href:i,class:"btn btn-primary"},"Full Recap")," ",Object(r.createElement)("a",{href:p,class:"btn btn-primary"},"Gallery ( ",f," images)"))))},save:e=>{const{attributes:{className:t},setAttributes:l}=e,{summary:c,stars:n,recaplink:s,gallerylink:i,gallerycount:u}=e.attributes;return Object(r.createElement)(a,null,Object(r.createElement)("div",{className:t+" flf-recap card w-75"},Object(r.createElement)("div",{class:"card-body"},Object(r.createElement)("div",{class:"flf-rating"},Object(r.createElement)(d,{value:n})),Object(r.createElement)(o.Content,{tagName:"p",value:c,class:"card-text"}),Object(r.createElement)(f,{link:s})," ",Object(r.createElement)(v,{link:i,count:u}))))}}),l(2);const{registerBlockType:w}=wp.blocks,{createElement:y}=wp.element,{RichText:h,InspectorControls:j}=wp.blockEditor,{SelectControl:O,ToggleControl:E}=wp.components;w("flfblocks/spoilers",{title:"Spoiler Warning",icon:y("svg",{"aria-hidden":"true","data-prefix":"far","data-icon":"flushed",role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 496 512",class:"svg-inline--fa fa-flushed fa-w-16 fa-3x"},y("path",{fill:"currentColor",d:"M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm96-312c-44.2 0-80 35.8-80 80s35.8 80 80 80 80-35.8 80-80-35.8-80-80-80zm0 128c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-72c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm-112 24c0-44.2-35.8-80-80-80s-80 35.8-80 80 35.8 80 80 80 80-35.8 80-80zm-80 48c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-72c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm160 144H184c-13.2 0-24 10.8-24 24s10.8 24 24 24h128c13.2 0 24-10.8 24-24s-10.8-24-24-24z",class:""})),category:"flfblocks",customClassName:!1,className:!1,attributes:{content:{source:"children",selector:"div",default:"Warning: This post contains spoilers!"}},description:"Uh uh uh, no spoilers, sweetie.",save:function(e){const t=e.attributes.content;return y("div",{className:"flf-spoiler alert alert-danger"},React.createElement(h.Content,{value:t}))},edit:function(e){const t=e.attributes.content,l=e.focus,r=y(h,{tagName:"div",className:e.className,onChange:function(t){e.setAttributes({content:t})},value:t,focus:l,onFocus:e.setFocus});return y("div",{className:"alert alert-danger"},r)}}),wp.data.select("core/edit-post").isFeatureActive("fullscreenMode")&&wp.data.dispatch("core/edit-post").toggleFeature("fullscreenMode")}]);