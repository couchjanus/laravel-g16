<style>

  .ais-Pagination ul {
    padding: 0;
    margin: 0;
    list-style: none;
    display: flex;
  }

  .ais-Pagination {
    margin: 10px 0;
    text-align: center;
    
  }

  .ais-Pagination li {
    margin: 0 0.2em;
  }

  .ais-Pagination li a {
    font-size: 1.2em;
    text-decoration: none;
    color: rgba(0, 0, 0, 0.4);
    
  }
  .ais-Pagination li:active a {
      font-weight: bold;
      color: rgba(0, 100, 220, 0.6);
  }
</style>
<template>
  <ais-instant-search
    :search-client="searchClient"
     index-name="posts"
  >
  <ais-search-box placeholder="Search posts..."></ais-search-box>
    <ais-hits>
      <template
          slot="item"
          slot-scope="{ item }"
        >
          <h2>
            <ais-highlight
              :hit="item"
              attribute="title"
            />
          </h2>
          <div>
            {{ item.content|subStr }}
          </div>
          
          <h4>
            <ais-highlight
              :hit="item"
              attribute="created_at"
            />
          </h4>

           <a :href="'blog/'+item.slug"><button>Read more</button></a>

        </template>
    </ais-hits>

    <ais-pagination>
      <ul
        slot-scope="{
          currentRefinement,
          nbPages,
          pages,
          isFirstPage,
          isLastPage,
          refine,
          createURL
        }"
      >
        <li v-if="!isFirstPage">
          <a :href="createURL(0)" @click.prevent="refine(0)">
            ‹‹
          </a>
        </li>
        <li v-if="!isFirstPage">
          <a
            :href="createURL(currentRefinement - 1)"
            @click.prevent="refine(currentRefinement - 1)"
          >
            ‹
          </a>
        </li>
        <li v-for="page in pages" :key="page">
          <a
            :href="createURL(page)"
            :style="{ fontWeight: page === currentRefinement ? 'bold' : '' }"
            @click.prevent="refine(page)"
          >
            {{ page + 1 }}
          </a>
        </li>
        <li v-if="!isLastPage">
          <a
            :href="createURL(currentRefinement + 1)"
            @click.prevent="refine(currentRefinement + 1)"
          >
            ›
          </a>
        </li>
        <li v-if="!isLastPage">
          <a :href="createURL(nbPages)" @click.prevent="refine(nbPages)">
            ››
          </a>
        </li>
      </ul>
    </ais-pagination>
  </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';

export default {
  data() {
    return {
      searchClient: algoliasearch(
        process.env.MIX_ALGOLIA_APP_ID,
        process.env.MIX_ALGOLIA_SEARCH
      ),
    };
  },
  filters: {
  	subStr: function(string) {
    	return string.substring(0,100) + '...';
    }
  }
};
</script>
