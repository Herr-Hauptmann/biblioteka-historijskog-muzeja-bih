import{_ as i}from"./ImageCard-DUFbLuIj.js";import{l,c as n,b as o,F as d,k as c,a as m,w as u,u as f,o as a,e as g,d as p,P as h}from"./app-C72GuXjz.js";const w={class:"container mx-auto"},x={class:"container mx-auto px-7 my-4"},_={class:"overflow-hidden bg-white shadow sm:rounded-lg mx-auto pb-6"},v={class:"py-3 md:flex justify-center px-2"},B={__name:"News",setup(y){const r=l([]);return(async()=>{try{let e=await fetch(route("news.landing"));if(!e.ok)throw Error("News data not available");r.value=await e.json()}catch(e){console.log(e.message)}})(),(e,s)=>(a(),n("div",w,[o("div",x,[s[1]||(s[1]=o("h2",{class:"text-6xl mt-12 mb-5"},"Priče iz biblioteke",-1)),o("div",_,[o("div",v,[(a(!0),n(d,null,c(r.value,t=>(a(),g(i,{class:"m-3",key:t.id,title:t.title,image:t.image_path,description:t.description,link:e.route("news.show",t.id)},null,8,["title","image","description","link"]))),128))]),m(f(h),{class:"text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mx-6",href:e.route("news.list")},{default:u(()=>s[0]||(s[0]=[p("Pregledaj sve priče...")])),_:1},8,["href"])])])]))}};export{B as default};
