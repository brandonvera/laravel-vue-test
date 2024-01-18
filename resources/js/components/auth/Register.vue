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
                            <h3>Sign up</h3>
                            <p>Already have an account? <a href="/">Sign in</a></p>
                            </div>
                        </div>
                        </div>
                        <form @submit.prevent="register">
                        <div class="row gy-3 overflow-hidden">
                            <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="name" placeholder="username" required v-model="form.name">
                                <label for="email" class="form-label">Username</label>
                            </div>
                            </div>
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
                                <button class="btn btn-primary btn-lg" type="submit">Sign up now</button>
                            </div>
                            </div>
                        </div>
                        </form>
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
      username: '',
      email: '',
      password: '',
    });

    const router = useRouter();
    const error = ref(null);

    const register = async () => {
      try {
        const response = await axios.post('http://localhost:80/api/register', form);
        router.push({ name: 'login' });
      } catch (error) {
        console.error(error);
        error.value = 'Registration failed';
      }
    };

    return { form, error, register };
  },
};
</script>