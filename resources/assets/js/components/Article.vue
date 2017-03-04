<template>
    <div>
        <div v-if="!articles.length">Записи не найдены</div>
        <article class="post" v-for="article in articles">
            <a href="article.link" class="entry-media" v-if="article.image">
                <img src="http://farm8.staticflickr.com/7192/6902225428_aab1cb4ac6_c.jpg" alt="" />
            </a>
            <div class="entry-body">
                <a href="article.link">
                    <h2 class="entry-title">{{ article.title }}</h2>
                </a>
                <p>{{ article.short_description }}</p>
            </div>
            <div class="entry-meta">
                <span class="entry-type"></span>
                <span class="entry-date">{{ article.publishedDate }}</span>
                <span class="entry-comments"> {{ article.commentsCount }} комментариев</span>
            </div>
            <div class="clr"></div>
        </article>
    </div>
</template>

<script>
    import Pagination from './Pagination.vue'

    export default {

        props: ['itemsUrl'],

        data: function() {
            return {
                pagination: {
                    per_page: 10,
                    current_page: 1,
                    last_page: 1
                },
                offset: 4,// left and right padding from the pagination <span>,just change it to see effects
                items: [],
                url: itemsUrl
            }
        },

        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.last_page) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },

        methods: {
            fetchItems: function (page) {
                var data = {page: page};
                this.$http.post(this.url, data).then(function (response) {
                    //look into the routes file and format your response
                    this.items = response.data.data.data;
                    // this.pagination = response.data.data.meta.pagination;
                    this.pagination.per_page = response.data.data.meta.pagination.per_page;
                    this.pagination.current_page = response.data.data.meta.pagination.current_page;
                    this.pagination.last_page = response.data.data.meta.pagination.total_pages;
                    // this.$set('items', response.data.data.data);
                    // this.$set('pagination', response.data.meta.pagination);
                }, function (error) {
                    // handle error
                });
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchItems(page);
                $('#back-to-top').click();
            }
        },

        components: {
            Pagination
        },

        created: function() {
            this.fetchItems(this.pagination.current_page);
        }
        
        mounted() {
            console.log('Component ready.');
        }
    }
</script>