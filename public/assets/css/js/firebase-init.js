import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getFirestore } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";
import { getStorage } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-storage.js";

const firebaseConfig = {
  apiKey: "AIzaSyAEaNYnLa_Vmby-CcinQP8p6rDLPTOy9To",
  authDomain: "ecom-bb307.firebaseapp.com",
  projectId: "ecom-bb307",
  storageBucket: "ecom-bb307.firebasestorage.app",
  messagingSenderId: "84721523666",
  appId: "1:84721523666:web:2f7247934ac5e85481860b",
  measurementId: "G-8C23ZX7PDJ"
};

const app = initializeApp(firebaseConfig);
export const db = getFirestore(app);
export const auth = getAuth(app);
export const storage = getStorage(app);