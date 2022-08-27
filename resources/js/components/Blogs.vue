<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">All Blogs Data</h5>
                <div>
                    <button
                        class="btn btn-success"
                        type="button"
                        @click="this.$router.push('/blogs/add')"
                    >
                        New Blog
                    </button>
                </div>
            </div>

            <table class="table table-hover table-sm">
                <thead class="bg-dark text-light">
                    <tr>
                        <th width="50" class="text-center">#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-center" width="120">Image</th>
                        <th class="text-center" width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(blog, index) in blogs" :key="blog.id">
                        <td class="text-center">{{ index + 1 }}.</td>
                        <td>{{ blog.name }}</td>
                        <td>{{ blog.description }}</td>
                        <td class="text-center">
                            <div v-if="blog.image">
                                <img
                                    alt="blog-img"
                                    width="100"
                                    v-bind:src="'/img/' + blog.image"
                                />
                            </div>
                        </td>
                        <td class="text-center">
                            <router-link
                                :to="{
                                    name: 'editblog',
                                    params: { id: blog.id },
                                }"
                                class="btn btn-warning"
                                >Edit</router-link
                            >
                            <button
                                class="btn btn-danger"
                                @click="deleteBlog(blog.id)"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            blogs: [],
            strSuccess: "",
            strError: "",
        };
    },
    created() {
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
            this.$axios
                .get("/api/blogs")
                .then((response) => {
                    this.blogs = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    },
    methods: {
        deleteBlog(id) {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                let existingObj = this;

                if (confirm("Do you really want to delete this data?")) {
                    this.$axios
                        .delete(`/api/blogs/delete/${id}`)
                        .then((response) => {
                            let i = this.blogs
                                .map((item) => item.id)
                                .indexOf(id); // find index of your object
                            this.blogs.splice(i, 1);
                            existingObj.strError = "";
                            existingObj.strSuccess = response.data.success;
                        })
                        .catch(function (error) {
                            existingObj.strError = "";
                            existingObj.strSuccess =
                                error.response.data.message;
                        });
                }
            });
        },
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    },
};
</script>
