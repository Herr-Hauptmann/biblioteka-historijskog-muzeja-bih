import{C as c,h as g,e as p,w as i,o as a,a as o,u as t,m as y,b as n,c as v,g as _,d as r,n as b,P as x,f as h}from"./app-C72GuXjz.js";import{_ as k}from"./GuestLayout-BwcMO0Lz.js";import{_ as w}from"./PrimaryButton-C-JnnEAk.js";import"./portal-DnQLFngL.js";import"./keyboard-BUMieHnC.js";import"./use-resolve-button-type-BcJMUAQN.js";const V={key:0,class:"mb-4 font-medium text-sm text-green-600"},B={class:"mt-4 flex items-center justify-between"},P={__name:"VerifyEmail",props:{status:String},setup(d){const l=d,s=c(),m=()=>{s.post(route("verification.send"))},u=g(()=>l.status==="verification-link-sent");return(f,e)=>(a(),p(k,null,{default:i(()=>[o(t(y),{title:"Email Verification"}),e[2]||(e[2]=n("div",{class:"mb-4 text-sm text-gray-600"}," Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1)),u.value?(a(),v("div",V," A new verification link has been sent to the email address you provided during registration. ")):_("",!0),n("form",{onSubmit:h(m,["prevent"])},[n("div",B,[o(w,{class:b({"opacity-25":t(s).processing}),disabled:t(s).processing},{default:i(()=>e[0]||(e[0]=[r(" Resend Verification Email ")])),_:1},8,["class","disabled"]),o(t(x),{href:f.route("logout"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:i(()=>e[1]||(e[1]=[r("Log Out")])),_:1},8,["href"])])],32)]),_:1}))}};export{P as default};
