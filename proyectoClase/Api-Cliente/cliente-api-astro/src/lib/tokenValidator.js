// tokenValidator.js

export default function isValidToken() {
    if (typeof window !== 'undefined' && window.localStorage) {
        const token = localStorage.getItem('authToken');
        
        if (!token) {
            return false;
        }

        const parts = token.split('.');
        if (parts.length !== 3) {
            return false;
        }

        try {
            const payload = atob(parts[1]);
            const decoded = JSON.parse(payload);
            
            if (decoded.exp && Date.now() >= decoded.exp * 1000) {
                return false;
            }
            return true;
        } catch (e) {
            console.error('Error al decodificar el token', e);
            return false;
        }
    }
    return false;
}

