const Ziggy = {"url":"http:\/\/library-management.ir","port":null,"defaults":{},"routes":{"home":{"uri":"home","methods":["GET","HEAD"]},"home.profile":{"uri":"home\/profile","methods":["GET","HEAD"]},"home.users":{"uri":"home\/users","methods":["GET","HEAD"]},"home.categories":{"uri":"home\/categories","methods":["GET","HEAD"]},"home.members":{"uri":"home\/members","methods":["GET","HEAD"]},"home.ammanatketabjadid":{"uri":"home\/ammanatketabjadid","methods":["GET","HEAD","POST","PUT","PATCH","DELETE","OPTIONS"]},"home.ammanatdade":{"uri":"home\/ammanatdade","methods":["GET","HEAD","POST","PUT","PATCH","DELETE","OPTIONS"]},"home.books":{"uri":"home\/books","methods":["GET","HEAD","POST","PUT","PATCH","DELETE","OPTIONS"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
