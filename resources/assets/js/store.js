let store = {
    state: {
        cart: [],
        cartCount: 0,
        favourites: [],
        favouritesCount: 0,
    },
    mutations: {

        toggleFavourites(state, item) {

            axios.put('/api/favourites/' + item.id + '/toggle',).then(response => {

                this._vm.$message({
                    showClose: true,
                    message: response.data.message,
                    type: response.data.status
                });

                state.favourites = response.data.data;
                state.favouritesCount = response.data.data.length;
            }).catch(error => {
                if (error.response.status === 401) {
                    window.location.href = '/login';
                    console.log(error.response);
                }
            });

        },

        toggleCart(state, item) {

            axios.put('/api/cart/' + item.id + '/toggle',).then(response => {

                state.cart = response.data.data.items;
                state.cartCount = response.data.data.totalQuantity;

                console.log(response.data.data);

                this._vm.$message({
                    showClose: true,
                    message: response.data.message,
                    type: response.data.status
                });

            });

        },

        setInitialCart(state, cart) {
            console.log(cart);
            state.cartCount = cart.totalQuantity;
        }
    }
};

export default store;