import{r as b,h as y,c as d,o as u,a as l,u as a,m as w,w as o,b as e,d as c,F as f,k as _,P as p,t as j}from"./app-DOJjKQUX.js";import{_ as v,a as k}from"./SearchBar-Bb5LKoQw.js";import{_ as C}from"./AuthenticatedLayout-DHqg7U0m.js";import{C as O}from"./Content-Cb1M-izT.js";import{_ as I}from"./DeleteModal-Dn4JYodC.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./portal-DcqtfjuQ.js";import"./keyboard-CsV0scs_.js";import"./transition-CDbftH8o.js";const N={class:"flex justify-between"},$={class:"pb-12 pt-4"},z={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},B={class:"bg-white overflow-x-auto relative shadow-sm sm:rounded-lg"},D={class:"table-fixed md:table-auto w-full text-sm text-left text-gray-500"},M={scope:"row",class:"py-4 px-6 font-medium text-gray-900 md:whitespace-nowrap"},K={class:"py-4 px-6 text-right"},P=["onClick"],S="Pretraži ključne riječi",V="keywords.index",G=Object.assign({layout:C},{__name:"KeywordsIndex",props:{filters:Object,keywords:Object},setup(n){let i=b({id:null,deleteMessage:"ključnu riječ ",deleteRoute:"keywords.destroy",isOpen:!1});function m(t){i.isOpen=t}function h(t,s){i.id=s,i.deleteMessage='ključnu riječ "'+t+'"',m(!0)}let x=n,g=y(()=>{let t=JSON.parse(JSON.stringify(x.keywords));return delete t.data,t});return(t,s)=>(u(),d(f,null,[l(a(w),{title:"Ključne riječi"}),l(O,null,{header:o(()=>[e("div",N,[s[1]||(s[1]=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight my-auto"}," Ključne riječi ",-1)),l(a(p),{href:t.route("keywords.create")},{default:o(()=>s[0]||(s[0]=[e("button",{class:"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"}," Dodaj ključnu riječ ",-1)])),_:1},8,["href"])])]),default:o(()=>[l(I,{deleteInfo:a(i)},null,8,["deleteInfo"]),e("div",$,[e("div",z,[e("div",B,[l(v,{placeholder:S,filters:n.filters,path:V},null,8,["filters"]),e("table",D,[s[3]||(s[3]=e("thead",{class:"text-xs text-gray-700 uppercase bg-gray-50"},[e("tr",null,[e("th",{scope:"col",class:"py-3 px-6 hidden md:table-cell"},[e("div",{class:"flex items-center"},[c(" Naziv ključne riječi "),e("a",{href:"javascript:void(0)"},[e("svg",{xmlns:"http://www.w3.org/2000/svg",class:"ml-1 w-3 h-3","aria-hidden":"true",fill:"currentColor",viewBox:"0 0 320 512"},[e("path",{d:"M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"})])])])]),e("th",{scope:"col",class:"py-3 px-6"},[e("span",{class:"sr-only"},"Uredi")])])],-1)),e("tbody",null,[(u(!0),d(f,null,_(n.keywords.data,r=>(u(),d("tr",{key:r.id,class:"bg-white border-b hover:bg-gray-200"},[e("th",M,[l(a(p),{href:t.route("keywords.books",r.id)},{default:o(()=>[c(j(r.title),1)]),_:2},1032,["href"])]),e("td",K,[l(a(p),{href:t.route("keywords.edit",r.id),class:"font-medium text-blue-600 hover:underline px-2"},{default:o(()=>s[2]||(s[2]=[c("Uredi")])),_:2},1032,["href"]),e("a",{onClick:F=>h(r.title,r.id),href:"javascript:void(0)",class:"font-medium text-red-600 hover:underline px-2"},"Izbriši",8,P)])]))),128))])]),l(k,{data:a(g)},null,8,["data"])])])])]),_:1})],64))}});export{G as default};
