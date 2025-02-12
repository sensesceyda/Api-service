<template>
    <div class="background">
        <div class="container">
            <div class="header text-center">
                <h2>Seyahat Sigortası Teklifi</h2>
                <p>En iyi fiyatlarla güvenli seyahat edin!</p>
            </div>

            <div class="glass-card">
                <div class="card-header">
                    <h5>Sigorta Ürünleri</h5>
                </div>
                <div class="card-body">
                    <ul class="list">
                        <li v-for="product in products" :key="product.urun">
                            <strong>{{ product.aciklama }}</strong>
                            <ul v-if="product.urunIds" class="sub-list">
                                <li v-for="urun in product.urunIds" :key="urun.urun_id">
                                    {{ urun.aciklama }} (ID: {{ urun.urun_id }})
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="glass-card form-card">
                <div class="card-header">
                    <h5>Fiyat Al</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="fetchPrice">
                        <div class="mb-3">
                            <label class="form-label">Sigortalı Sayısı                </label>
                            <input type="number" v-model="form.sigortaliSayisi" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Başlangıç Tarihi                </label>
                            <input type="date" v-model="form.baslangicTarihi" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bitiş Tarihi                      </label>
                            <input type="date" v-model="form.bitisTarihi" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ülke Kodu                         </label>
                            <input type="number" v-model="form.ulkeKodu" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ürün Seçimi                        </label>
                            <select v-model="form.urun" class="form-select">
                                <option value="yurtici-seyahat">Yurt İçi Seyahat</option>
                                <option value="yurtdisi-seyahat">Yurt Dışı Seyahat</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-custom">Fiyat Al</button>
                    </form>
                </div>
            </div>

            <div v-if="priceData" class="glass-card price-box">
                <h4>Fiyat Bilgisi</h4>
                <p><strong>Ürün:</strong>{{ priceData.urunBilgileri.urunAdi }}</p>
                <p class="price"><strong>Fiyat:</strong> <span>{{ priceData.urunBilgileri.fiyat }}</span></p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            products: [],
            form: {
                sigortaliSayisi: 1,
                baslangicTarihi: new Date().toISOString().slice(0, 10),
                bitisTarihi: new Date(new Date().setDate(new Date().getDate() + 7)).toISOString().slice(0, 10),
                ulkeKodu: 276,
                urun: "yurtdisi-seyahat",
            },
            priceData: null,
        };
    },
    mounted() {
        axios.get("/api/urun-kodlari")
            .then(response => {
                this.products = response.data.urunKodlari;
            })
            .catch(error => console.error("Ürün kodları alınamadı:", error));
    },
    methods: {
        async fetchPrice() {
            try {
                const response = await axios.post("/api/fiyat-al", this.form);
                this.priceData = response.data.data;
            } catch (error) {
                this.priceData = null;
                alert("Fiyat alınamadı! Lütfen bilgileri kontrol edin.");
            }
        }
    }
};
</script>

<style scoped>

.background {
    background-size: cover; 
    background: linear-gradient(to right, #6a11cb, #2575fc);
    display: flex;
    align-items: center;
    justify-content: center;
}


.container {
    max-width: 700px;
    text-align: center;
    color: white;
}


.glass-card {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
}


.glass-card:hover {
    transform: scale(1.03);
}


.card-header {
    font-size: 1.2rem;
    font-weight: bold;
    text-align: center;
    padding: 10px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
}


.form-control, .form-select {
    padding: 12px;
    font-size: 1rem;
    border-radius: 10px;
    border: none;
    outline: none;
}

.btn-custom {
    background: linear-gradient(to right, #ff416c, #ff4b2b);
    color: white;
    font-size: 1.2rem;
    padding: 12px;
    width: 100%;
    border-radius: 10px;
    transition: all 0.3s ease-in-out;
    border: none;
    outline: none;
}

.btn-custom:hover {
    background: linear-gradient(to right, #ff4b2b, #ff416c);
    transform: scale(1.05);
}


.price-box .price span {
    font-size: 1.8rem;
    font-weight: bold;
    color: #ffeb3b;
}
.mb-3{
    margin: 20px;
    
}
list{
    margin-left: 0px;
    padding: 0;
}
</style>
