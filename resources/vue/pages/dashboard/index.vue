<script>
import TopBar from "../../components/dashboard/topbar.vue";
import Slider from "../../components/dashboard/slider-component.vue";
import ArticleList from "../../components/dashboard/article-list.vue";
import Gallery from "../../components/dashboard/gallery-component.vue";

export default {
    name: "Dashboard",
    components: {
        TopBar,
        Slider,
        ArticleList,
        Gallery,
    },
};
</script>

<template>
    <div>
        <TopBar />
        <Slider />
        <div class="uk-container">
            <ArticleList />
            <Gallery />
        </div>
    </div>
</template>

<style scoped>
/* Styles for the dashboard */
</style>
