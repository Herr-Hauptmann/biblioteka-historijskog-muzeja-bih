import{C as m,c as a,a as r,u as o,w as n,F as c,o as i,m as g,b as e,f as p,t as u,g as f}from"./app-C72GuXjz.js";import{_ as x}from"./AuthenticatedLayout-DnooFrRX.js";import{C as b}from"./Content-DRK60UmJ.js";import{_ as y}from"./InputError-qjZZ_3NM.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const _={class:"py-12"},h={class:"mx-auto sm:px-6 lg:px-8"},v={class:"col-span-10 bg-white overflow-hidden shadow-sm sm:rounded-lg"},k={class:"p-6 text-gray-900"},w={class:"grid grid-cols-12 gap-2 content-center"},j={class:"col-span-10"},C=["value"],S=Object.assign({layout:x},{__name:"Import",setup(B){const s=m({sheet:null});function l(){s.post(route("books.import"))}return(I,t)=>(i(),a(c,null,[r(o(g),{title:"Import data"}),r(b,null,{header:n(()=>t[1]||(t[1]=[e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"},"Učitavanje podataka",-1)])),default:n(()=>[e("div",_,[e("div",h,[e("main",v,[e("div",k,[e("form",{onSubmit:p(l,["prevent"])},[e("div",w,[e("div",j,[t[2]||(t[2]=e("label",{class:"block mb-2 text-sm font-medium text-gray-900 dark:text-white",for:"sheet"},"Učitavanje knjiga",-1)),e("input",{name:"sheet",onInput:t[0]||(t[0]=d=>o(s).sheet=d.target.files[0]),class:"block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50","aria-describedby":"sheet_help",id:"sheet",type:"file"},null,32),t[3]||(t[3]=e("p",{class:"mt-1 text-sm text-gray-500",id:"sheet_help"},"Odaberite excel datoteku.",-1)),r(y,{class:"mt-2",message:o(s).errors.sheet},null,8,["message"]),o(s).progress?(i(),a("progress",{key:0,value:o(s).progress.percentage,max:"100"},u(o(s).progress.percentage)+"% ",9,C)):f("",!0)]),t[4]||(t[4]=e("div",{class:"col-span-2 flex justify-center content-center align-center"},[e("div",{class:"flex flex-col justify-center content-center align-center"},[e("button",{type:"submit",class:"py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200"},"Učitaj knjige")])],-1))])],32)])])])])]),_:1})],64))}});export{S as default};
