let store = {
    state: {
        shoppingCart: [],
        shoppingCartCount: 0,
        favoriteArtworks: [],
        favoriteArtworksCount: 0,
        errors: [],
    },
    mutations: {

        toggleFavorites(state, item) {

            axios.put('/api/user/favorite/' + item.id + '/toggle',).then(response => {

                // this._vm.$message({
                //     dangerouslyUseHTMLString: true,
                //     showClose: true,
                //     message: response.data.message,
                //     type: response.data.status
                // });

                state.favoriteArtworks = response.data.data;
                state.favoriteArtworksCount = response.data.data.length;
            }).catch(error => {
                if (error.response.status === 401) {
                    window.location.href = '/login';
                    console.log(error.response);
                }
            });

        },

        toggleShoppingCart(state, item) {

            axios.get('/cart/item/' + item.id + '/toggle',).then(response => {

                state.shoppingCart = response.data.data;

                state.shoppingCartCount = response.data.data.length ;

                // console.log(response.data.data, 'got data');

                // this._vm.$message({
                //     dangerouslyUseHTMLString: true,
                //     showClose: true,
                //     message: response.data.message,
                //     type: response.data.status
                // });

            });

        },

        setInitialShoppingCart(state, cart) {
            // console.log('Initial shopping cart', cart);
            state.shoppingCartCount = cart.length;
            state.shoppingCart = cart;

        },

        setInitialFavoriteArtworks(state, favoriteArtworks) {
            // console.log('Initial favorite artworks', favoriteArtworks.length);
            state.favoriteArtworksCount = favoriteArtworks.length;
            state.favoriteArtworks = favoriteArtworks;
        },

        setErrors(state, errors) {
            console.log(errors);
            state.errors = errors;
        }
    }
};

export default store;