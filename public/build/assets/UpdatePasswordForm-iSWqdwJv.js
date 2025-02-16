import{l as m,C as _,c,b as o,a as e,u as r,w as i,V as v,f as g,o as w,d as y,g as V}from"./app-C72GuXjz.js";import{_ as l}from"./InputError-qjZZ_3NM.js";import{a as n,_ as d}from"./TextInput-Dmobe5Lp.js";import{_ as x}from"./PrimaryButton-C-JnnEAk.js";const k={class:"flex items-center gap-4"},P={key:0,class:"text-sm text-gray-600"},$={__name:"UpdatePasswordForm",setup(b){const u=m(null),p=m(null),s=_({current_password:"",password:"",password_confirmation:""}),f=()=>{s.put(route("password.update"),{preserveScroll:!0,onSuccess:()=>s.reset(),onError:()=>{s.errors.password&&(s.reset("password","password_confirmation"),u.value.focus()),s.errors.current_password&&(s.reset("current_password"),p.value.focus())}})};return(S,a)=>(w(),c("section",null,[a[4]||(a[4]=o("header",null,[o("h2",{class:"text-lg font-medium text-gray-900"}," Update Password "),o("p",{class:"mt-1 text-sm text-gray-600"}," Ensure your account is using a long, random password to stay secure. ")],-1)),o("form",{onSubmit:g(f,["prevent"]),class:"mt-6 space-y-6"},[o("div",null,[e(d,{for:"current_password",value:"Current Password"}),e(n,{id:"current_password",ref_key:"currentPasswordInput",ref:p,modelValue:r(s).current_password,"onUpdate:modelValue":a[0]||(a[0]=t=>r(s).current_password=t),type:"password",class:"mt-1 block w-full",autocomplete:"current-password"},null,8,["modelValue"]),e(l,{message:r(s).errors.current_password,class:"mt-2"},null,8,["message"])]),o("div",null,[e(d,{for:"password",value:"New Password"}),e(n,{id:"password",ref_key:"passwordInput",ref:u,modelValue:r(s).password,"onUpdate:modelValue":a[1]||(a[1]=t=>r(s).password=t),type:"password",class:"mt-1 block w-full",autocomplete:"new-password"},null,8,["modelValue"]),e(l,{message:r(s).errors.password,class:"mt-2"},null,8,["message"])]),o("div",null,[e(d,{for:"password_confirmation",value:"Confirm Password"}),e(n,{id:"password_confirmation",modelValue:r(s).password_confirmation,"onUpdate:modelValue":a[2]||(a[2]=t=>r(s).password_confirmation=t),type:"password",class:"mt-1 block w-full",autocomplete:"new-password"},null,8,["modelValue"]),e(l,{message:r(s).errors.password_confirmation,class:"mt-2"},null,8,["message"])]),o("div",k,[e(x,{disabled:r(s).processing},{default:i(()=>a[3]||(a[3]=[y("Save")])),_:1},8,["disabled"]),e(v,{"enter-active-class":"transition ease-in-out","enter-from-class":"opacity-0","leave-active-class":"transition ease-in-out","leave-to-class":"opacity-0"},{default:i(()=>[r(s).recentlySuccessful?(w(),c("p",P," Saved. ")):V("",!0)]),_:1})])],32)]))}};export{$ as default};
