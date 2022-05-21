export default function auth({ next, router }) {
    if (false) {
      return router.push('login');
    }

    return next();
  }
