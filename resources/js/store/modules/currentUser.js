
const state = {
    user:{},
    keygen: ""
};
const getters ={
    getkey(state){
        return state.keygen
    }
};
const actions = {

    loggedUser({},user){
        console.log("nani");
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post('login-request',user).then(response => {
                console.log(response);
                if (response.data=='/'){
                console.log(response);
                localStorage.setItem(
                        "login_token",
                        response.data.access_token
                    )

               // self.$router.push('/')
              }else{
                self.$router.push('login')
              }
            })
            .catch(function (error) {
                      console.log(error);
                  });

          })
    }
};
const mutations = {
    storeLogin(state,payload){
        console.log("nani");
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post('login-request',user).then(response => {
                if (response.data=='/'){
                console.log(response);
                state.keygen = response.data.access_token

               // self.$router.push('/')
              }else{
               // self.$router.push('login')
              }
            })
            .catch(function (error) {
                      console.log(error);
                  });

          })
    }
};

export default{
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
