<template>
    <div class="container index-picture-component">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Brawse</div>
                    <div class="card-body">
                        <div class="row" v-if="picture.items.length > 0">    
                            <div class="col-6" v-for="pic in picture.items" :key="pic.id">
                                <a :href="'/picture/' + pic.id">
                                    <img 
                                        :src="pic.picture" 
                                        :alt="pic.title"
                                        class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <h3 v-else class="card-title">We just started! Soon there will be lots of pictures ;)</h3>

                        <div class="row" v-if="picture.paginate.total > picture.paginate.per_page">
                            <div class="col-12 pt-3">
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li :class="{'page-item' : true,  'disabled' : !picture.paginate.prev_page_url}">
                                            <a class="page-link" :href="picture.paginate.prev_page_url" @click.prevent="loadPictures(picture.paginate.prev_page_url)" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item active">
                                            <span class="page-link">
                                                {{ picture.paginate.current_page }}
                                                <span class="sr-only">(current)</span>
                                            </span>
                                        </li>
                                        <li :class="{'page-item' : true,  'disabled' : !picture.paginate.next_page_url}">
                                            <a class="page-link" :href="picture.paginate.next_page_url" @click.prevent="loadPictures(picture.paginate.next_page_url)">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header">Filters</div>
                    <div class="card-body">
                        <div class="row">
                            <form :id="'form-' + this._uid" @submit.prevent="filterPictures">

                                <div class="form-group">
                                    <tags-input element-id="tags"
                                        v-model="picture.filters.tags.selected"
                                        input-class="form-control"
                                        :existingTags="picture.filters.tags.existing"
                                        :typeahead="true"
                                        :only-existing-tags="true"
                                        >
                                    </tags-input>
                                </div>

                                <button type="submit" class="btn btn-primary">Filter Pictures</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                picture: {
                    items: '',
                    paginate:{
                        current_page: '',
                        first_page_url: '',
                        from: '',
                        next_page_url: '',
                        path: '',
                        per_page: '',
                        prev_page_url: '',
                        to: '',
                        total: '',
                    },
                    filters: {
                        tags: {
                            selected: '',
                            existing: {},
                        }
                    }
                },
            }
        },
        
        mounted() {
            this.loadPictures('picture');
            this.loadTags();
        },

        methods:{
            setPicturePaginateInfo(paginateInfo){
                this.picture.paginate.current_page = paginateInfo.current_page;
                this.picture.paginate.first_page_url = paginateInfo.first_page_url;
                this.picture.paginate.from = paginateInfo.from;
                this.picture.paginate.next_page_url = paginateInfo.next_page_url;
                this.picture.paginate.path = paginateInfo.path;
                this.picture.paginate.per_page = paginateInfo.per_page;
                this.picture.paginate.prev_page_url = paginateInfo.prev_page_url;
                this.picture.paginate.to = paginateInfo.to;
                this.picture.paginate.total = paginateInfo.total;
            },

            loadPictures(url){
                axios.get(url)
                .then( response => {
                    this.picture.items = response.data.data;
                    this.setPicturePaginateInfo(response.data);
                })
                .catch(error => {
                    console.log(error);
                })
            },

            loadTags(){
                axios.get('/tag')
                    .then(response => {
                        response.data.forEach(tag =>{
                            let slug = tag.slug;
                            let obj = {};
                            obj[slug] = tag.name;
                            Object.assign(this.picture.filters.tags.existing, obj);
                        })
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            filterPictures(){
                 axios.get('/picture',{
                        params: {
                            tags: this.picture.filters.tags.selected,
                        }
                 })
                    .then(response => {
                        console.log(response.data);                        
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>
