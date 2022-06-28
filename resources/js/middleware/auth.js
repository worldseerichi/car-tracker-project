export default async function auth({ next, router, store }) {

    if (store.getters.getAdminLogged == false) {
      return next({
        name: "Login",
      });
    }

    return next();
  }
