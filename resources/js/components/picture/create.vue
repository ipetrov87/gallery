<template>
    <div class="container create-picture-component">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Add picture</div>
                    <div class="card-body">
                        <form :id="'form-' + this._uid" @submit.prevent="submitForm" action="/picture">
                            
                            <div class="form-group">
                                <label :for="'form-' + this._uid + '-title'">Picture titile</label>
                                <input 
                                    type="input" 
                                    :class="{ 'is-invalid': picture.title.error, 'form-control' : true }" 
                                    :id="'form-' +  this._uid+ '-title'" 
                                    @keypress="picture.title.error = ''"
                                    placeholder="Sky in fire" 
                                    v-model="picture.title.value">
                                <div class="invalid-feedback">
                                    {{ picture.title.error }}
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label :for="'form-' + this._uid + '-descriprion'">Descriprion</label>
                                <textarea 
                                    :class="{ 'is-invalid': picture.description.error, 'form-control' : true }" 
                                    :id="'form-' + this._uid + '-descriprion'" 
                                    @keypress="picture.description.error = ''"
                                    rows="3" 
                                    v-model="picture.description.value"></textarea>
                                <div class="invalid-feedback">
                                    {{ picture.description.error }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input 
                                        type="file" 
                                        :class="{ 'is-invalid': picture.picture.error, 'custom-file-input' : true }" 
                                        id="customFile" 
                                        accept="image/*" 
                                        @change="pictureOnChange">
                                    <label class="custom-file-label" for="customFile">{{ this.picture.picture.value }}</label>
                                    <div class="invalid-feedback">
                                        {{ picture.picture.error }}
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Add</button>

                            <!-- <div class="status"></div> -->
                        </form>
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
                    title: {
                        value: '',
                        error: '',
                    },
                    description: {
                        value: '',
                        error: '',
                    },
                    picture:{
                        value: 'Choose file',
                        error: '',
                        file: '',
                    },
                    status: ''
                },
            }
        },

        methods:{
            submitForm(e){
                
                let data = new FormData();
                data.append('title', this.picture.title.value);
                data.append('description', this.picture.description.value);
                data.append('picture', this.picture.picture.file);

                axios.post(e.target.action, data)
                .then(response => {
                    this.resetForm();
                })
                .catch(error => {
                    for (const er in error.response.data.errors){
                        this.picture[er].error = error.response.data.errors[er][0];
                    };
                });
            },

            resetFormValidation(){
                this.picture.title.error ='';
                this.picture.description.error = '';
                this.picture.picture.error = '';
            },

            resetForm(){
                this.picture.title.value = '';
                this.picture.description.value = '';
                this.picture.picture.value = 'Choose file';
                this.resetFormValidation();
            },

            pictureOnChange(e){
                if (!e.target.files[0]) return;

                this.picture.picture.error = '';

                console.log(e);

                this.picture.picture.file = e.target.files[0];
                this.picture.picture.value= this.picture.picture.file.name;

                let reader = new FileReader();
                reader.readAsDataURL(this.picture.picture.file);
                // reader.onload = e => {
                //     this.picture.value = e.target.result;
                // }
            }
        }
    }
</script>
