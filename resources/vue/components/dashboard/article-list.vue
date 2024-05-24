<template>
    <div>
        <h2>Daftar Artikel</h2>
        <div
            v-for="(article, index) in articles"
            :key="index"
            class="uk-card uk-card-default uk-margin"
        >
            <div class="uk-card-media-top">
                <img :src="article.photo" alt="" />
            </div>
            <div class="uk-card-body">
                <h3 class="uk-card-title">{{ article.title }}</h3>
                <p>{{ article.content }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ArticleList",
    data() {
        return {
            articles: [
                {
                    title: "Article 1",
                    content: "Content 1",
                    photo: "../../assets/images/image-1.jpg",
                },
                {
                    title: "Article 2",
                    content: "Content 2",
                    photo: "../../assets/images/image-2.jpg",
                },
                {
                    title: "Article 3",
                    content: "Content 3",
                    photo: "../../assets/images/image-3.jpg",
                },
            ],
        };
    },
};
</script>

<style scoped>
/* Styles for the article list */
</style>
