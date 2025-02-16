import{_ as I,I as N,B as $,l as T,h as D,K as M,H as k,F as H,D as C,G as U}from"./app-C72GuXjz.js";var O;let R=Symbol("headlessui.useid"),_=0;const he=(O=I)!=null?O:function(){return N(R,()=>`${++_}`)()};function P(e){var t;if(e==null||e.value==null)return null;let n=(t=e.value.$el)!=null?t:e.value;return n instanceof Node?n:null}function y(e,t,...n){if(e in t){let o=t[e];return typeof o=="function"?o(...n):o}let r=new Error(`Tried to handle "${e}" but there is no handler defined. Only defined handlers are: ${Object.keys(t).map(o=>`"${o}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(r,y),r}var K=Object.defineProperty,W=(e,t,n)=>t in e?K(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n,S=(e,t,n)=>(W(e,typeof t!="symbol"?t+"":t,n),n);let G=class{constructor(){S(this,"current",this.detect()),S(this,"currentId",0)}set(t){this.current!==t&&(this.currentId=0,this.current=t)}reset(){this.set(this.detect())}nextId(){return++this.currentId}get isServer(){return this.current==="server"}get isClient(){return this.current==="client"}detect(){return typeof window>"u"||typeof document>"u"?"server":"client"}},E=new G;function V(e){if(E.isServer)return null;if(e instanceof Node)return e.ownerDocument;if(e!=null&&e.hasOwnProperty("value")){let t=P(e);if(t)return t.ownerDocument}return document}let b=["[contentEditable=true]","[tabindex]","a[href]","area[href]","button:not([disabled])","iframe","input:not([disabled])","select:not([disabled])","textarea:not([disabled])"].map(e=>`${e}:not([tabindex='-1'])`).join(",");var B=(e=>(e[e.First=1]="First",e[e.Previous=2]="Previous",e[e.Next=4]="Next",e[e.Last=8]="Last",e[e.WrapAround=16]="WrapAround",e[e.NoScroll=32]="NoScroll",e))(B||{}),q=(e=>(e[e.Error=0]="Error",e[e.Overflow=1]="Overflow",e[e.Success=2]="Success",e[e.Underflow=3]="Underflow",e))(q||{}),X=(e=>(e[e.Previous=-1]="Previous",e[e.Next=1]="Next",e))(X||{});function Y(e=document.body){return e==null?[]:Array.from(e.querySelectorAll(b)).sort((t,n)=>Math.sign((t.tabIndex||Number.MAX_SAFE_INTEGER)-(n.tabIndex||Number.MAX_SAFE_INTEGER)))}var A=(e=>(e[e.Strict=0]="Strict",e[e.Loose=1]="Loose",e))(A||{});function z(e,t=0){var n;return e===((n=V(e))==null?void 0:n.body)?!1:y(t,{0(){return e.matches(b)},1(){let r=e;for(;r!==null;){if(r.matches(b))return!0;r=r.parentElement}return!1}})}var J=(e=>(e[e.Keyboard=0]="Keyboard",e[e.Mouse=1]="Mouse",e))(J||{});typeof window<"u"&&typeof document<"u"&&(document.addEventListener("keydown",e=>{e.metaKey||e.altKey||e.ctrlKey||(document.documentElement.dataset.headlessuiFocusVisible="")},!0),document.addEventListener("click",e=>{e.detail===1?delete document.documentElement.dataset.headlessuiFocusVisible:e.detail===0&&(document.documentElement.dataset.headlessuiFocusVisible="")},!0));function we(e){e==null||e.focus({preventScroll:!0})}let Q=["textarea","input"].join(",");function Z(e){var t,n;return(n=(t=e==null?void 0:e.matches)==null?void 0:t.call(e,Q))!=null?n:!1}function ee(e,t=n=>n){return e.slice().sort((n,r)=>{let o=t(n),u=t(r);if(o===null||u===null)return 0;let l=o.compareDocumentPosition(u);return l&Node.DOCUMENT_POSITION_FOLLOWING?-1:l&Node.DOCUMENT_POSITION_PRECEDING?1:0})}function ge(e,t,{sorted:n=!0,relativeTo:r=null,skipElements:o=[]}={}){var u;let l=(u=Array.isArray(e)?e.length>0?e[0].ownerDocument:document:e==null?void 0:e.ownerDocument)!=null?u:document,i=Array.isArray(e)?n?ee(e):e:Y(e);o.length>0&&i.length>1&&(i=i.filter(d=>!o.includes(d))),r=r??l.activeElement;let m=(()=>{if(t&5)return 1;if(t&10)return-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),a=(()=>{if(t&1)return 0;if(t&2)return Math.max(0,i.indexOf(r))-1;if(t&4)return Math.max(0,i.indexOf(r))+1;if(t&8)return i.length-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),s=t&32?{preventScroll:!0}:{},p=0,h=i.length,f;do{if(p>=h||p+h<=0)return 0;let d=a+p;if(t&16)d=(d+h)%h;else{if(d<0)return 3;if(d>=h)return 1}f=i[d],f==null||f.focus(s),p+=m}while(f!==l.activeElement);return t&6&&Z(f)&&f.select(),2}function te(){return/iPhone/gi.test(window.navigator.platform)||/Mac/gi.test(window.navigator.platform)&&window.navigator.maxTouchPoints>0}function ne(){return/Android/gi.test(window.navigator.userAgent)}function re(){return te()||ne()}function v(e,t,n){E.isServer||$(r=>{document.addEventListener(e,t,n),r(()=>document.removeEventListener(e,t,n))})}function oe(e,t,n){E.isServer||$(r=>{window.addEventListener(e,t,n),r(()=>window.removeEventListener(e,t,n))})}function be(e,t,n=D(()=>!0)){function r(u,l){if(!n.value||u.defaultPrevented)return;let i=l(u);if(i===null||!i.getRootNode().contains(i))return;let m=function a(s){return typeof s=="function"?a(s()):Array.isArray(s)||s instanceof Set?s:[s]}(e);for(let a of m){if(a===null)continue;let s=a instanceof HTMLElement?a:P(a);if(s!=null&&s.contains(i)||u.composed&&u.composedPath().includes(s))return}return!z(i,A.Loose)&&i.tabIndex!==-1&&u.preventDefault(),t(u,i)}let o=T(null);v("pointerdown",u=>{var l,i;n.value&&(o.value=((i=(l=u.composedPath)==null?void 0:l.call(u))==null?void 0:i[0])||u.target)},!0),v("mousedown",u=>{var l,i;n.value&&(o.value=((i=(l=u.composedPath)==null?void 0:l.call(u))==null?void 0:i[0])||u.target)},!0),v("click",u=>{re()||o.value&&(r(u,()=>o.value),o.value=null)},!0),v("touchend",u=>r(u,()=>u.target instanceof HTMLElement?u.target:null),!0),oe("blur",u=>r(u,()=>window.document.activeElement instanceof HTMLIFrameElement?window.document.activeElement:null),!0)}var ue=(e=>(e[e.None=0]="None",e[e.RenderStrategy=1]="RenderStrategy",e[e.Static=2]="Static",e))(ue||{}),ie=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(ie||{});function le({visible:e=!0,features:t=0,ourProps:n,theirProps:r,...o}){var u;let l=x(r,n),i=Object.assign(o,{props:l});if(e||t&2&&l.static)return g(i);if(t&1){let m=(u=l.unmount)==null||u?0:1;return y(m,{0(){return null},1(){return g({...o,props:{...l,hidden:!0,style:{display:"none"}}})}})}return g(i)}function g({props:e,attrs:t,slots:n,slot:r,name:o}){var u,l;let{as:i,...m}=ae(e,["unmount","static"]),a=(u=n.default)==null?void 0:u.call(n,r),s={};if(r){let p=!1,h=[];for(let[f,d]of Object.entries(r))typeof d=="boolean"&&(p=!0),d===!0&&h.push(f);p&&(s["data-headlessui-state"]=h.join(" "))}if(i==="template"){if(a=j(a??[]),Object.keys(m).length>0||Object.keys(t).length>0){let[p,...h]=a??[];if(!se(p)||h.length>0)throw new Error(['Passing props on "template"!',"",`The current component <${o} /> is rendering a "template".`,"However we need to passthrough the following props:",Object.keys(m).concat(Object.keys(t)).map(c=>c.trim()).filter((c,w,L)=>L.indexOf(c)===w).sort((c,w)=>c.localeCompare(w)).map(c=>`  - ${c}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "template".',"Render a single element as the child so that we can forward the props onto that element."].map(c=>`  - ${c}`).join(`
`)].join(`
`));let f=x((l=p.props)!=null?l:{},m,s),d=M(p,f,!0);for(let c in f)c.startsWith("on")&&(d.props||(d.props={}),d.props[c]=f[c]);return d}return Array.isArray(a)&&a.length===1?a[0]:a}return k(i,Object.assign({},m,s),{default:()=>a})}function j(e){return e.flatMap(t=>t.type===H?j(t.children):[t])}function x(...e){if(e.length===0)return{};if(e.length===1)return e[0];let t={},n={};for(let r of e)for(let o in r)o.startsWith("on")&&typeof r[o]=="function"?(n[o]!=null||(n[o]=[]),n[o].push(r[o])):t[o]=r[o];if(t.disabled||t["aria-disabled"])return Object.assign(t,Object.fromEntries(Object.keys(n).map(r=>[r,void 0])));for(let r in n)Object.assign(t,{[r](o,...u){let l=n[r];for(let i of l){if(o instanceof Event&&o.defaultPrevented)return;i(o,...u)}}});return t}function ye(e){let t=Object.assign({},e);for(let n in t)t[n]===void 0&&delete t[n];return t}function ae(e,t=[]){let n=Object.assign({},e);for(let r of t)r in n&&delete n[r];return n}function se(e){return e==null?!1:typeof e.type=="string"||typeof e.type=="object"||typeof e.type=="function"}var de=(e=>(e[e.None=1]="None",e[e.Focusable=2]="Focusable",e[e.Hidden=4]="Hidden",e))(de||{});let Ee=C({name:"Hidden",props:{as:{type:[Object,String],default:"div"},features:{type:Number,default:1}},setup(e,{slots:t,attrs:n}){return()=>{var r;let{features:o,...u}=e,l={"aria-hidden":(o&2)===2?!0:(r=u["aria-hidden"])!=null?r:void 0,hidden:(o&4)===4?!0:void 0,style:{position:"fixed",top:1,left:1,width:1,height:0,padding:0,margin:-1,overflow:"hidden",clip:"rect(0, 0, 0, 0)",whiteSpace:"nowrap",borderWidth:"0",...(o&4)===4&&(o&2)!==2&&{display:"none"}}};return le({ourProps:l,theirProps:u,slot:{},attrs:n,slots:t,name:"Hidden"})}}}),F=Symbol("Context");var ce=(e=>(e[e.Open=1]="Open",e[e.Closed=2]="Closed",e[e.Closing=4]="Closing",e[e.Opening=8]="Opening",e))(ce||{});function Oe(){return fe()!==null}function fe(){return N(F,null)}function Se(e){U(F,e)}var pe=(e=>(e.Space=" ",e.Enter="Enter",e.Escape="Escape",e.Backspace="Backspace",e.Delete="Delete",e.ArrowLeft="ArrowLeft",e.ArrowUp="ArrowUp",e.ArrowRight="ArrowRight",e.ArrowDown="ArrowDown",e.Home="Home",e.End="End",e.PageUp="PageUp",e.PageDown="PageDown",e.Tab="Tab",e))(pe||{});export{le as A,ye as E,ue as N,ee as O,ge as P,we as S,ae as T,ce as a,de as b,he as c,pe as d,Y as e,Ee as f,z as g,A as h,V as i,B as j,q as k,fe as l,E as m,re as n,P as o,oe as p,te as q,ie as r,Oe as s,Se as t,y as u,be as w};
