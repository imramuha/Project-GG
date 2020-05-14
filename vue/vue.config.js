module.exports = {
    css: {
        loaderOptions: {
            sass: {
                prependData: `@import "@/assets/sass/main.scss";`
            }
        }
    }
};