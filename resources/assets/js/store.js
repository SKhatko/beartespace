let store = {
    state: {
        shoppingCart: [],
        shoppingCartCount: 0,
        favouriteArtworks: [],
        favouriteArtworksCount: 0,
        errors: [],
    },
    mutations: {

        toggleFavourites(state, item) {

            axios.put('/api/user/favourite/' + item.id + '/toggle',).then(response => {

                this._vm.$message({
                    showClose: true,
                    message: response.data.message,
                    type: response.data.status
                });

                state.favouriteArtworks = response.data.data;
                state.favouriteArtworksCount = response.data.data.length;
            }).catch(error => {
                if (error.response.status === 401) {
                    window.location.href = '/login';
                    console.log(error.response);
                }
            });

        },

        toggleShoppingCart(state, item) {

            axios.put('/api/cart/' + item.id + '/toggle',).then(response => {

                state.shoppingCart = response.data.data;

                state.shoppingCartCount = response.data.data.length ;

                console.log(response.data.data, 'got data');

                this._vm.$message({
                    showClose: true,
                    message: response.data.message,
                    type: response.data.status
                });

            });

        },

        setInitialShoppingCart(state, cart) {
            console.log('Initial shopping cart', cart);
            state.shoppingCartCount = cart.length;
            state.shoppingCart = cart;

        },

        setInitialFavouriteArtworks(state, favouriteArtworks) {
            console.log('Initial favourite artworks', favouriteArtworks.length);
            state.favouriteArtworksCount = favouriteArtworks.length;
            state.favouriteArtworks = favouriteArtworks;
        },

        setErrors(state, errors) {
            console.log(errors);
            state.errors = errors;
        }
    }
};

export default store;