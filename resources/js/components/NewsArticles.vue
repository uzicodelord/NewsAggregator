<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        Latest News
                    </div>
                    <div class="card-body">
                        <div v-for="article in articles" :key="article.id" class="news-article">
                            <h4>{{ article.title }}</h4>
                            <p>{{ article.content }}</p>
                            <img :src="article.image" v-if="article.image" class="img-fluid">
                            <br>
                            <a :href="article.source">{{ article.source }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.news-article {
    border-bottom: 1px solid #eee;
    margin-bottom: 20px;
    padding-bottom: 20px;
}
</style>

<script>
import axios from 'axios';

export default {
    props: ['articles'],
    created() {
        axios.get('/news')
            .then(response => {
                this.articles = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    }
}
</script>
