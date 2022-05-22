import axios from 'axios';
export default async function auth({ next, router }) {
    let authCheck = '';
    await axios.get('loginCheck').then(function (response) {
        authCheck = response.data;
    }).catch(function (error) {
        console.log(error);
    }); //change this to use $store variables to check for auth

    if (authCheck == '') {
      return router.push('login');
    }

    return next();
  }
