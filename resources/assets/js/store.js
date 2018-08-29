let store = {
    state: {
        cart: [],
        cartCount: 0,
        favouriteArtworks: [],
        favouriteArtworksCount: 0,
        errors: [],
    },
    mutations: {

        toggleFavourites(state, item) {

            axios.put('/api/favourites/' + item.id + '/toggle',).then(response => {

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
        },

        setInitialFavouriteArtworks(state, favouriteArtworks) {
            console.log('artworks', favouriteArtworks.length);
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