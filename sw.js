self.addEventListener("install", e=>{
 e.waitUntil(
  caches.open("cotton").then(c=>c.addAll(["/cotton-app/"]))
 );
});

self.addEventListener("fetch", e=>{
 e.respondWith(fetch(e.request).catch(()=>caches.match(e.request)));
});
