import { getAuth, signInWithEmailAndPassword, GoogleAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

const auth = getAuth();

export const loginUser = async (email, password) => {
    try {
        const userCredential = await signInWithEmailAndPassword(auth, email, password);
        const idToken = await userCredential.user.getIdToken();
        
        // Pass token to PHP for session persistence
        const response = await fetch('/api/verify-token.php', {
            method: 'POST',
            body: JSON.stringify({ token: idToken })
        });
        window.location.href = '/dashboard';
    } catch (error) {
        console.error("Auth Error:", error.code);
    }
};