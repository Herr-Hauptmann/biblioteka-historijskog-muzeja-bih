import{C as l,e as n,o as d,w as t,a as e,b as r,u as a,m as p,f,n as u,d as c}from"./app-DOJjKQUX.js";import{_}from"./GuestLayout-DrkUyO83.js";import{_ as w}from"./InputError-Bnes0oqH.js";import{_ as b,a as x}from"./TextInput-bKeWPDVG.js";import{_ as g}from"./PrimaryButton-B8IBkgCA.js";import"./portal-DcqtfjuQ.js";import"./keyboard-CsV0scs_.js";import"./use-resolve-button-type-B4H3Y3le.js";const C={class:"flex justify-end mt-4"},j={__name:"ConfirmPassword",setup(V){const s=l({password:""}),i=()=>{s.post(route("password.confirm"),{onFinish:()=>s.reset()})};return(v,o)=>(d(),n(_,null,{default:t(()=>[e(a(p),{title:"Confirm Password"}),o[2]||(o[2]=r("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1)),r("form",{onSubmit:f(i,["prevent"])},[r("div",null,[e(b,{for:"password",value:"Password"}),e(x,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:a(s).password,"onUpdate:modelValue":o[0]||(o[0]=m=>a(s).password=m),required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),e(w,{class:"mt-2",message:a(s).errors.password},null,8,["message"])]),r("div",C,[e(g,{class:u(["ml-4",{"opacity-25":a(s).processing}]),disabled:a(s).processing},{default:t(()=>o[1]||(o[1]=[c(" Confirm ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{j as default};
