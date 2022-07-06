export default async function auth({ next, router, store, to}) {

    /*if (store.getters.getAdminLogged == true && to.fullPath == '/login'){
        return next({
            name: "Home",
        });
    }*/
    if (store.getters.getAdminLogged == false && to.fullPath != '/login') {
      return next({
        name: "Login",
      });
    }

    return next();
  }
