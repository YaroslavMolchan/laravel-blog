<template>
    <div>
        <hr>

        <div class="pagination">
            <ul>
                <li v-if="pagination.current_page > 1">
                    <a href="#" aria-label="Previous"
                       @click.prevent="changePage(pagination.current_page - 1)">
                        &larr; Пред.
                    </a>
                </li>
                <li v-for="page in pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '']">
                    <a href="#"
                       @click.prevent="changePage(page)">@{{ page }}</a>
                </li>
                <li v-if="pagination.current_page < pagination.last_page">
                    <a href="#" aria-label="Next"
                       @click.prevent="changePage(pagination.current_page + 1)">
                        След. &rarr;
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['url'],

        data: function() {
            return {
                pagination: {
                    per_page: 10,
                    current_page: 1,
                    last_page: 1
                },
                offset: 4,// left and right padding from the pagination <span>,just change it to see effects
                items: []
            }
        },

        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
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
                this.$http.get(this.url, data).then(function (response) {
                    //look into the routes file and format your response
                    // this.$set('items', response.data.data.data);
                    this.$set('pagination', response.data.meta.pagination);
                    this.$set('pagination-items', response.data.data.data);
                }, function (error) {
                    // handle error
                });
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchItems(page);
            }
        },

        created() {
            this.fetchItems(this.pagination.current_page);
        },
        
        mounted() {
            console.log('Component ready.');
        }
    }
</script>