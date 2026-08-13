document.addEventListener("DOMContentLoaded",()=>{

// mobile menu toggle
const menuBtn=document.getElementById("menuBtn");
const mobileMenu=document.getElementById("mobileMenu");
if(menuBtn && mobileMenu){
 const closeMenu=()=>{
  menuBtn.setAttribute("aria-expanded","false");
  mobileMenu.classList.remove("is-open");
  mobileMenu.setAttribute("aria-hidden","true");
  document.body.classList.remove("menu-open");
 };
 const openMenu=()=>{
  menuBtn.setAttribute("aria-expanded","true");
  mobileMenu.classList.add("is-open");
  mobileMenu.setAttribute("aria-hidden","false");
  document.body.classList.add("menu-open");
 };
 menuBtn.addEventListener("click",()=>{
  const isOpen=menuBtn.getAttribute("aria-expanded")==="true";
  isOpen?closeMenu():openMenu();
 });
 mobileMenu.querySelectorAll("a").forEach(a=>a.addEventListener("click",closeMenu));
 addEventListener("keydown",e=>{if(e.key==="Escape")closeMenu()});
}

// navbar transparent-to-solid on scroll
const header=document.getElementById("siteHeader");
if(header){
 const updateHeader=()=>{
  header.classList.toggle("is-transparent",scrollY<40);
 };
 addEventListener("scroll",updateHeader,{passive:true});
 updateHeader();
}

const items=document.querySelectorAll(".reveal,.reveal-right");
const io=new IntersectionObserver(entries=>entries.forEach((e,i)=>{
 if(!e.isIntersecting)return;
 setTimeout(()=>e.target.classList.add("show"),i*70);
 io.unobserve(e.target);
}),{threshold:.12});
items.forEach(x=>io.observe(x));

const counters=document.querySelectorAll(".counter");
const animate=c=>{
 const target=+c.dataset.target,start=performance.now(),duration=1500;
 const tick=now=>{
  const p=Math.min((now-start)/duration,1),ease=1-Math.pow(1-p,3);
  c.textContent=Math.floor(target*ease);
  if(p<1)requestAnimationFrame(tick);else c.textContent=target;
 };
 requestAnimationFrame(tick);
};
const co=new IntersectionObserver(es=>es.forEach(e=>{
 if(e.isIntersecting){animate(e.target);co.unobserve(e.target)}
}),{threshold:.7});
counters.forEach(c=>co.observe(c));

const timeline=document.querySelector(".timeline");
if(timeline){
 const line=document.createElement("div");
 line.style.cssText="position:absolute;left:118px;top:0;width:1px;height:0;background:#e59a12;box-shadow:0 0 12px rgba(229,154,18,.5);z-index:1;transition:height .12s linear";
 timeline.appendChild(line);
 const update=()=>{
  const r=timeline.getBoundingClientRect();
  line.style.height=Math.max(0,Math.min(window.innerHeight*.55-r.top,r.height))+"px";
 };
 addEventListener("scroll",update,{passive:true});addEventListener("resize",update);update();
}

const photo=document.querySelector(".hero-photo");
if(photo && matchMedia("(pointer:fine)").matches){
 document.addEventListener("mousemove",e=>{
  const x=(e.clientX/innerWidth-.5)*8,y=(e.clientY/innerHeight-.5)*8;
  photo.style.transform=`translate3d(${x}px,${y}px,0)`;
 });
}
document.querySelectorAll(".gold-btn,.connect-btn").forEach(b=>{
 if(!matchMedia("(pointer:fine)").matches)return;
 b.addEventListener("mousemove",e=>{
  const r=b.getBoundingClientRect(),x=e.clientX-r.left-r.width/2,y=e.clientY-r.top-r.height/2;
  b.style.transform=`translate(${x*.08}px,${y*.08}px)`;
 });
 b.addEventListener("mouseleave",()=>b.style.transform="");
});
});