import{D as Y,l as g,h as s,q as A,A as C,H as S,F as Ne,B as ee,x as z,s as Be,G as te,I as le,J as Me,C as je,o as He,e as _e,w as R,a as B,u as x,b as D,d as Ie,t as We,g as Ve}from"./app-C72GuXjz.js";import{n as Ue,E as me,d as I,q as qe,N as Ye,$ as ze,z as Ge,u as ie}from"./portal-DnQLFngL.js";import{i as ge,f as se,b as de,A as G,S as O,o as b,u as q,P as U,j as F,k as Je,q as Ke,c as ae,l as Qe,a as W,w as Xe,N as fe,d as Ze}from"./keyboard-BUMieHnC.js";import{a as he,t as ce,o as be,h as pe,S as et}from"./transition-ChhTMOiO.js";function ye(e){if(!e)return new Set;if(typeof e=="function")return new Set(e());let t=new Set;for(let l of e.value){let n=b(l);n instanceof HTMLElement&&t.add(n)}return t}var we=(e=>(e[e.None=1]="None",e[e.InitialFocus=2]="InitialFocus",e[e.TabLock=4]="TabLock",e[e.FocusLock=8]="FocusLock",e[e.RestoreFocus=16]="RestoreFocus",e[e.All=30]="All",e))(we||{});let M=Object.assign(Y({name:"FocusTrap",props:{as:{type:[Object,String],default:"div"},initialFocus:{type:Object,default:null},features:{type:Number,default:30},containers:{type:[Object,Function],default:g(new Set)}},inheritAttrs:!1,setup(e,{attrs:t,slots:l,expose:n}){let a=g(null);n({el:a,$el:a});let o=s(()=>ge(a)),u=g(!1);A(()=>u.value=!0),C(()=>u.value=!1),lt({ownerDocument:o},s(()=>u.value&&!!(e.features&16)));let r=at({ownerDocument:o,container:a,initialFocus:s(()=>e.initialFocus)},s(()=>u.value&&!!(e.features&2)));nt({ownerDocument:o,container:a,containers:e.containers,previousActiveElement:r},s(()=>u.value&&!!(e.features&8)));let i=Ue();function f(v){let p=b(a);p&&(h=>h())(()=>{q(i.value,{[I.Forwards]:()=>{U(p,F.First,{skipElements:[v.relatedTarget]})},[I.Backwards]:()=>{U(p,F.Last,{skipElements:[v.relatedTarget]})}})})}let m=g(!1);function w(v){v.key==="Tab"&&(m.value=!0,requestAnimationFrame(()=>{m.value=!1}))}function y(v){if(!u.value)return;let p=ye(e.containers);b(a)instanceof HTMLElement&&p.add(b(a));let h=v.relatedTarget;h instanceof HTMLElement&&h.dataset.headlessuiFocusGuard!=="true"&&(Ee(p,h)||(m.value?U(b(a),q(i.value,{[I.Forwards]:()=>F.Next,[I.Backwards]:()=>F.Previous})|F.WrapAround,{relativeTo:v.target}):v.target instanceof HTMLElement&&O(v.target)))}return()=>{let v={},p={ref:a,onKeydown:w,onFocusout:y},{features:h,initialFocus:E,containers:P,...k}=e;return S(Ne,[!!(h&4)&&S(se,{as:"button",type:"button","data-headlessui-focus-guard":!0,onFocus:f,features:de.Focusable}),G({ourProps:p,theirProps:{...t,...k},slot:v,attrs:t,slots:l,name:"FocusTrap"}),!!(h&4)&&S(se,{as:"button",type:"button","data-headlessui-focus-guard":!0,onFocus:f,features:de.Focusable})])}}}),{features:we});function tt(e){let t=g(ce.slice());return z([e],([l],[n])=>{n===!0&&l===!1?he(()=>{t.value.splice(0)}):n===!1&&l===!0&&(t.value=ce.slice())},{flush:"post"}),()=>{var l;return(l=t.value.find(n=>n!=null&&n.isConnected))!=null?l:null}}function lt({ownerDocument:e},t){let l=tt(t);A(()=>{ee(()=>{var n,a;t.value||((n=e.value)==null?void 0:n.activeElement)===((a=e.value)==null?void 0:a.body)&&O(l())},{flush:"post"})}),C(()=>{t.value&&O(l())})}function at({ownerDocument:e,container:t,initialFocus:l},n){let a=g(null),o=g(!1);return A(()=>o.value=!0),C(()=>o.value=!1),A(()=>{z([t,l,n],(u,r)=>{if(u.every((f,m)=>(r==null?void 0:r[m])===f)||!n.value)return;let i=b(t);i&&he(()=>{var f,m;if(!o.value)return;let w=b(l),y=(f=e.value)==null?void 0:f.activeElement;if(w){if(w===y){a.value=y;return}}else if(i.contains(y)){a.value=y;return}w?O(w):U(i,F.First|F.NoScroll)===Je.Error&&console.warn("There are no focusable elements inside the <FocusTrap />"),a.value=(m=e.value)==null?void 0:m.activeElement})},{immediate:!0,flush:"post"})}),a}function nt({ownerDocument:e,container:t,containers:l,previousActiveElement:n},a){var o;me((o=e.value)==null?void 0:o.defaultView,"focus",u=>{if(!a.value)return;let r=ye(l);b(t)instanceof HTMLElement&&r.add(b(t));let i=n.value;if(!i)return;let f=u.target;f&&f instanceof HTMLElement?Ee(r,f)?(n.value=f,O(f)):(u.preventDefault(),u.stopPropagation(),O(i)):O(n.value)},!0)}function Ee(e,t){for(let l of e)if(l.contains(t))return!0;return!1}function ot(e){let t=Be(e.getSnapshot());return C(e.subscribe(()=>{t.value=e.getSnapshot()})),t}function rt(e,t){let l=e(),n=new Set;return{getSnapshot(){return l},subscribe(a){return n.add(a),()=>n.delete(a)},dispatch(a,...o){let u=t[a].call(l,...o);u&&(l=u,n.forEach(r=>r()))}}}function ut(){let e;return{before({doc:t}){var l;let n=t.documentElement;e=((l=t.defaultView)!=null?l:window).innerWidth-n.clientWidth},after({doc:t,d:l}){let n=t.documentElement,a=n.clientWidth-n.offsetWidth,o=e-a;l.style(n,"paddingRight",`${o}px`)}}}function it(){return Ke()?{before({doc:e,d:t,meta:l}){function n(a){return l.containers.flatMap(o=>o()).some(o=>o.contains(a))}t.microTask(()=>{var a;if(window.getComputedStyle(e.documentElement).scrollBehavior!=="auto"){let r=be();r.style(e.documentElement,"scrollBehavior","auto"),t.add(()=>t.microTask(()=>r.dispose()))}let o=(a=window.scrollY)!=null?a:window.pageYOffset,u=null;t.addEventListener(e,"click",r=>{if(r.target instanceof HTMLElement)try{let i=r.target.closest("a");if(!i)return;let{hash:f}=new URL(i.href),m=e.querySelector(f);m&&!n(m)&&(u=m)}catch{}},!0),t.addEventListener(e,"touchstart",r=>{if(r.target instanceof HTMLElement)if(n(r.target)){let i=r.target;for(;i.parentElement&&n(i.parentElement);)i=i.parentElement;t.style(i,"overscrollBehavior","contain")}else t.style(r.target,"touchAction","none")}),t.addEventListener(e,"touchmove",r=>{if(r.target instanceof HTMLElement){if(r.target.tagName==="INPUT")return;if(n(r.target)){let i=r.target;for(;i.parentElement&&i.dataset.headlessuiPortal!==""&&!(i.scrollHeight>i.clientHeight||i.scrollWidth>i.clientWidth);)i=i.parentElement;i.dataset.headlessuiPortal===""&&r.preventDefault()}else r.preventDefault()}},{passive:!1}),t.add(()=>{var r;let i=(r=window.scrollY)!=null?r:window.pageYOffset;o!==i&&window.scrollTo(0,o),u&&u.isConnected&&(u.scrollIntoView({block:"nearest"}),u=null)})})}}:{}}function st(){return{before({doc:e,d:t}){t.style(e.documentElement,"overflow","hidden")}}}function dt(e){let t={};for(let l of e)Object.assign(t,l(t));return t}let L=rt(()=>new Map,{PUSH(e,t){var l;let n=(l=this.get(e))!=null?l:{doc:e,count:0,d:be(),meta:new Set};return n.count++,n.meta.add(t),this.set(e,n),this},POP(e,t){let l=this.get(e);return l&&(l.count--,l.meta.delete(t)),this},SCROLL_PREVENT({doc:e,d:t,meta:l}){let n={doc:e,d:t,meta:dt(l)},a=[it(),ut(),st()];a.forEach(({before:o})=>o==null?void 0:o(n)),a.forEach(({after:o})=>o==null?void 0:o(n))},SCROLL_ALLOW({d:e}){e.dispose()},TEARDOWN({doc:e}){this.delete(e)}});L.subscribe(()=>{let e=L.getSnapshot(),t=new Map;for(let[l]of e)t.set(l,l.documentElement.style.overflow);for(let l of e.values()){let n=t.get(l.doc)==="hidden",a=l.count!==0;(a&&!n||!a&&n)&&L.dispatch(l.count>0?"SCROLL_PREVENT":"SCROLL_ALLOW",l),l.count===0&&L.dispatch("TEARDOWN",l)}});function ft(e,t,l){let n=ot(L),a=s(()=>{let o=e.value?n.value.get(e.value):void 0;return o?o.count>0:!1});return z([e,t],([o,u],[r],i)=>{if(!o||!u)return;L.dispatch("PUSH",o,l);let f=!1;i(()=>{f||(L.dispatch("POP",r??o,l),f=!0)})},{immediate:!0}),a}let Q=new Map,j=new Map;function ve(e,t=g(!0)){ee(l=>{var n;if(!t.value)return;let a=b(e);if(!a)return;l(function(){var u;if(!a)return;let r=(u=j.get(a))!=null?u:1;if(r===1?j.delete(a):j.set(a,r-1),r!==1)return;let i=Q.get(a);i&&(i["aria-hidden"]===null?a.removeAttribute("aria-hidden"):a.setAttribute("aria-hidden",i["aria-hidden"]),a.inert=i.inert,Q.delete(a))});let o=(n=j.get(a))!=null?n:0;j.set(a,o+1),o===0&&(Q.set(a,{"aria-hidden":a.getAttribute("aria-hidden"),inert:a.inert}),a.setAttribute("aria-hidden","true"),a.inert=!0)})}let $e=Symbol("StackContext");var X=(e=>(e[e.Add=0]="Add",e[e.Remove=1]="Remove",e))(X||{});function ct(){return le($e,()=>{})}function pt({type:e,enabled:t,element:l,onUpdate:n}){let a=ct();function o(...u){n==null||n(...u),a(...u)}A(()=>{z(t,(u,r)=>{u?o(0,e,l):r===!0&&o(1,e,l)},{immediate:!0,flush:"sync"})}),C(()=>{t.value&&o(1,e,l)}),te($e,o)}let vt=Symbol("DescriptionContext");function mt({slot:e=g({}),name:t="Description",props:l={}}={}){let n=g([]);function a(o){return n.value.push(o),()=>{let u=n.value.indexOf(o);u!==-1&&n.value.splice(u,1)}}return te(vt,{register:a,slot:e,name:t,props:l}),s(()=>n.value.length>0?n.value.join(" "):void 0)}var gt=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(gt||{});let Z=Symbol("DialogContext");function ne(e){let t=le(Z,null);if(t===null){let l=new Error(`<${e} /> is missing a parent <Dialog /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(l,ne),l}return t}let V="DC8F892D-2EBD-447C-A4C8-A03058436FF4",ht=Y({name:"Dialog",inheritAttrs:!1,props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},open:{type:[Boolean,String],default:V},initialFocus:{type:Object,default:null},id:{type:String,default:null},role:{type:String,default:"dialog"}},emits:{close:e=>!0},setup(e,{emit:t,attrs:l,slots:n,expose:a}){var o,u;let r=(o=e.id)!=null?o:`headlessui-dialog-${ae()}`,i=g(!1);A(()=>{i.value=!0});let f=!1,m=s(()=>e.role==="dialog"||e.role==="alertdialog"?e.role:(f||(f=!0,console.warn(`Invalid role [${m}] passed to <Dialog />. Only \`dialog\` and and \`alertdialog\` are supported. Using \`dialog\` instead.`)),"dialog")),w=g(0),y=Qe(),v=s(()=>e.open===V&&y!==null?(y.value&W.Open)===W.Open:e.open),p=g(null),h=s(()=>ge(p));if(a({el:p,$el:p}),!(e.open!==V||y!==null))throw new Error("You forgot to provide an `open` prop to the `Dialog`.");if(typeof v.value!="boolean")throw new Error(`You provided an \`open\` prop to the \`Dialog\`, but the value is not a boolean. Received: ${v.value===V?void 0:e.open}`);let E=s(()=>i.value&&v.value?0:1),P=s(()=>E.value===0),k=s(()=>w.value>1),oe=le(Z,null)!==null,[Te,Se]=qe(),{resolveContainers:J,mainTreeNodeRef:re,MainTreeNode:De}=Ye({portals:Te,defaultContainers:[s(()=>{var d;return(d=N.panelRef.value)!=null?d:p.value})]}),xe=s(()=>k.value?"parent":"leaf"),ue=s(()=>y!==null?(y.value&W.Closing)===W.Closing:!1),Fe=s(()=>oe||ue.value?!1:P.value),Le=s(()=>{var d,c,$;return($=Array.from((c=(d=h.value)==null?void 0:d.querySelectorAll("body > *"))!=null?c:[]).find(T=>T.id==="headlessui-portal-root"?!1:T.contains(b(re))&&T instanceof HTMLElement))!=null?$:null});ve(Le,Fe);let Oe=s(()=>k.value?!0:P.value),Ae=s(()=>{var d,c,$;return($=Array.from((c=(d=h.value)==null?void 0:d.querySelectorAll("[data-headlessui-portal]"))!=null?c:[]).find(T=>T.contains(b(re))&&T instanceof HTMLElement))!=null?$:null});ve(Ae,Oe),pt({type:"Dialog",enabled:s(()=>E.value===0),element:p,onUpdate:(d,c)=>{if(c==="Dialog")return q(d,{[X.Add]:()=>w.value+=1,[X.Remove]:()=>w.value-=1})}});let ke=mt({name:"DialogDescription",slot:s(()=>({open:v.value}))}),H=g(null),N={titleId:H,panelRef:g(null),dialogState:E,setTitleId(d){H.value!==d&&(H.value=d)},close(){t("close",!1)}};te(Z,N);let Re=s(()=>!(!P.value||k.value));Xe(J,(d,c)=>{d.preventDefault(),N.close(),Me(()=>c==null?void 0:c.focus())},Re);let Ce=s(()=>!(k.value||E.value!==0));me((u=h.value)==null?void 0:u.defaultView,"keydown",d=>{Ce.value&&(d.defaultPrevented||d.key===Ze.Escape&&(d.preventDefault(),d.stopPropagation(),N.close()))});let Pe=s(()=>!(ue.value||E.value!==0||oe));return ft(h,Pe,d=>{var c;return{containers:[...(c=d.containers)!=null?c:[],J]}}),ee(d=>{if(E.value!==0)return;let c=b(p);if(!c)return;let $=new ResizeObserver(T=>{for(let K of T){let _=K.target.getBoundingClientRect();_.x===0&&_.y===0&&_.width===0&&_.height===0&&N.close()}});$.observe(c),d(()=>$.disconnect())}),()=>{let{open:d,initialFocus:c,...$}=e,T={...l,ref:p,id:r,role:m.value,"aria-modal":E.value===0?!0:void 0,"aria-labelledby":H.value,"aria-describedby":ke.value},K={open:E.value===0};return S(ie,{force:!0},()=>[S(ze,()=>S(Ge,{target:p.value},()=>S(ie,{force:!1},()=>S(M,{initialFocus:c,containers:J,features:P.value?q(xe.value,{parent:M.features.RestoreFocus,leaf:M.features.All&~M.features.FocusLock}):M.features.None},()=>S(Se,{},()=>G({ourProps:T,theirProps:{...$,...l},slot:K,attrs:l,slots:n,visible:E.value===0,features:fe.RenderStrategy|fe.Static,name:"Dialog"})))))),S(De)])}}}),bt=Y({name:"DialogPanel",props:{as:{type:[Object,String],default:"div"},id:{type:String,default:null}},setup(e,{attrs:t,slots:l,expose:n}){var a;let o=(a=e.id)!=null?a:`headlessui-dialog-panel-${ae()}`,u=ne("DialogPanel");n({el:u.panelRef,$el:u.panelRef});function r(i){i.stopPropagation()}return()=>{let{...i}=e,f={id:o,ref:u.panelRef,onClick:r};return G({ourProps:f,theirProps:i,slot:{open:u.dialogState.value===0},attrs:t,slots:l,name:"DialogPanel"})}}}),yt=Y({name:"DialogTitle",props:{as:{type:[Object,String],default:"h2"},id:{type:String,default:null}},setup(e,{attrs:t,slots:l}){var n;let a=(n=e.id)!=null?n:`headlessui-dialog-title-${ae()}`,o=ne("DialogTitle");return A(()=>{o.setTitleId(a),C(()=>o.setTitleId(null))}),()=>{let{...u}=e;return G({ourProps:{id:a},theirProps:u,slot:{open:o.dialogState.value===0},attrs:t,slots:l,name:"DialogTitle"})}}});const wt={class:"fixed inset-0 overflow-y-auto"},Et={class:"flex min-h-full items-center justify-center p-4 text-center"},$t={class:"mt-2"},Tt={class:"text-sm text-gray-1200"},St={class:"mt-4 flex justify-between"},Ot={__name:"DeleteModal",props:{deleteInfo:Object},setup(e){const t=e,l=s(()=>t.deleteInfo);function n(u){t.deleteInfo.isOpen=u}const a=je();let o=function(u){a.delete(route(t.deleteInfo.deleteRoute,u)),n(!1)};return(u,r)=>l.value?(He(),_e(x(et),{key:0,appear:"",show:l.value.isOpen,as:"template"},{default:R(()=>[B(x(ht),{as:"div",onClose:r[2]||(r[2]=i=>n(!1)),class:"relative z-10"},{default:R(()=>[B(x(pe),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0","enter-to":"opacity-100",leave:"duration-200 ease-in","leave-from":"opacity-100","leave-to":"opacity-0"},{default:R(()=>r[3]||(r[3]=[D("div",{class:"fixed inset-0 bg-black bg-opacity-25"},null,-1)])),_:1}),D("div",wt,[D("div",Et,[B(x(pe),{as:"template",enter:"duration-300 ease-out","enter-from":"opacity-0 scale-95","enter-to":"opacity-100 scale-100",leave:"duration-200 ease-in","leave-from":"opacity-100 scale-100","leave-to":"opacity-0 scale-95"},{default:R(()=>[B(x(bt),{class:"w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"},{default:R(()=>[B(x(yt),{as:"h3",class:"text-lg font-medium leading-6 text-gray-900"},{default:R(()=>r[4]||(r[4]=[Ie(" Da li ste sigurni? ")])),_:1}),D("div",$t,[D("p",Tt," Da li ste sigurni da želite obrisati "+We(l.value.deleteMessage)+"? Ova akcija je trajna i ne može se vratiti. ",1)]),D("div",St,[D("button",{type:"button",class:"inline-flex justify-center rounded-md border border-transparent bg-red-300 px-4 py-2 text-sm font-medium hover:text-white hover:bg-red-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-100 focus-visible:ring-offset-2",onClick:r[0]||(r[0]=i=>x(o)(l.value.id))}," Da, obriši "),D("button",{type:"button",class:"inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2",onClick:r[1]||(r[1]=i=>n(!1))}," Odustani ")])]),_:1})]),_:1})])])]),_:1})]),_:1},8,["show"])):Ve("",!0)}};export{Ot as _};
