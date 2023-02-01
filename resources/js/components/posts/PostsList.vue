<template>
  <div>
    <!-- LOADER -->
    <LoaderComp v-if="isLoading" />

    <ul v-else-if="posts.length">
      <li v-for="post in posts" :key="post.id">
        <div class="card w-25 m-1">
          <img src="" class="card-img-top" alt="..." />
          <div class="card-body">
            <h4 class="card-title">Post title: {{ post.title }}</h4>

            <p class="card-text">Post body: {{ post.body }}</p>

            <h6 v-if="post.category" class="">{{ post.category.name }}</h6>

            <h6 v-for="tag in post.tags" :key="tag" class="">
              {{ tag.name }}
            </h6>
          </div>
        </div>
      </li>
    </ul>
    <p v-else>Non ci sono post nel db</p>

    <PaginationComp @on-page-change="getPosts" :pagination="pagination" />
  </div>
</template>

<script>
import LoaderComp from "../LoaderComp.vue";
import PaginationComp from "../PaginationComp.vue";

export default {
  name: "PostsList",

  data() {
    return {
      posts: [],
      isLoading: false,
      pagination: {},
    };
  },

  //   props: ["posts", "isLoading", "pagination"],

  components: {
    LoaderComp,
    PaginationComp,
  },

  mounted() {
    this.getPosts();
  },

  methods: {
    getPosts(page) {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/posts?page=" + page)
        .then((res) => {
          console.log(res.data);
          // this.posts = res.data.data;
          const { data, current_page, last_page } = res.data;
          this.posts = data;
          this.pagination = {
            lastPage: last_page,
            currentPage: current_page,
          };
        })
        .catch((err) => {
          console.log(err);
        })
        .then(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
