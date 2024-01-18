<template>
    <div>
      <section class="py-3 py-md-5 py-xl-8">
        <div class="container">
          <div class="row gy-4 d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-xl-5">
              <div class="card border-0 rounded-4">
                <div class="card-body p-3 p-md-4 p-xl-5">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-4">
                        <h3>Sign in</h3>
                        <p>Don't have an account? <a href="/register">Sign up</a></p>
                      </div>
                    </div>
                  </div>
                  <form @submit.prevent="login">
                    <div class="row gy-3 overflow-hidden">
                      <div class="col-12">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required v-model="form.email">
                          <label for="email" class="form-label">Email</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required v-model="form.password">
                          <label for="password" class="form-label">Password</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button class="btn btn-primary btn-lg" type="submit">Log in now</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </template>
  
  <script>
  import { ref, reactive } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  
  export default {
    setup() {
      const form = reactive({
        email: '',
        password: '',
      });
      
      const router = useRouter();
      const error = ref(null);
  
      const login = async () => {
        try {
          const response = await axios.post('http://localhost:80/api/login', form);
          localStorage.setItem('token', response.data.authorization.token);
          localStorage.setItem('id', response.data.user.id);
          router.push({ name: 'randomQuotes' });
        } catch (error) {
          console.error(error);
          error.value = 'Invalid email or password';
        }
      };
  
      return { form, error, login };
    },
  };
  </script>