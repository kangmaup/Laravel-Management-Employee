<template>
    <div>
        <h2>Galeri</h2>
        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div>
                <img
                    src="../../assets/images/image-1.jpg"
                    width="400"
                    height="600"
                    alt=""
                />
                <div class="uk-card uk-card-default uk-card-body">Item</div>
            </div>
            <div>
                <img
                    src="../../assets/images/image-2.jpg"
                    width="400"
                    height="600"
                    alt=""
                />
                <div class="uk-card uk-card-default uk-card-body">Item</div>
            </div>
            <div>
                <img
                    src="../../assets/images/image-3.jpg"
                    width="400"
                    height="600"
                    alt=""
                />
                <div class="uk-card uk-card-default uk-card-body">Item</div>
            </div>
            <div>
                <img
                    src="../../assets/images/image-4.jpg"
                    width="400"
                    height="600"
                    alt=""
                />
                <div class="uk-card uk-card-default uk-card-body">Item</div>
            </div>
            <div>
                <img
                    src="../../assets/images/image-5.jpg"
                    width="400"
                    height="600"
                    alt=""
                />
                <div class="uk-card uk-card-default uk-card-body">Item</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Gallery",
    data() {
        return {
            images: [
                "../../assets/images/image-1.jpg",
                "../../assets/images/image-2.jpg",
                "../../assets/images/image-3.jpg",
                "../../assets/images/image-4.jpg",
                "../../assets/images/image-5.jpg",
            ],
        };
    },
};
</script>

<style scoped>
/* Styles for the gallery */
.uk-card {
    margin-bottom: 20px;
}
</style>
