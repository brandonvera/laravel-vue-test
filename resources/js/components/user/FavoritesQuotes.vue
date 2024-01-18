<template>
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-8">
          <h3>Favorites Quotes</h3>
          <div class="card">
            <div class="card-body py-5">
              <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-9 col-xl-8">
                  <div v-for="quote in quotes" :key="quote.id" class="d-flex">
                    <div class="flex-grow-1 ms-4 ps-3">
                      <figure>
                        <blockquote class="blockquote mb-4">
                          <p>
                            <i class="fas fa-quote-left fa-lg text-warning me-2"></i>
                            <span class="font-italic">{{ quote.quote }}</span>
                          </p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                          {{ quote.author }}
                        </figcaption>
                      </figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  export default {
    setup() {
        const quotes = ref([]);
        const token = localStorage.getItem('token');
        const id = localStorage.getItem('id');

      const fetchQuotes = async () => {
        try {
            const response = await axios.get('http://localhost:80/api/favorites-quotes/' + id, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });
          quotes.value = response.data;
        } catch (error) {
          console.error('Error fetching quotes:', error);
        }
      };
  
      onMounted(fetchQuotes);
  
      return { quotes };
    },
  };
  </script>