// Gestionnaire de notifications en temps réel
class NotificationManager {
    constructor() {
        this.container = this.createContainer();
        this.notifications = [];
        document.body.appendChild(this.container);
    }

    createContainer() {
        const container = document.createElement('div');
        container.className = 'notification-container';
        container.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        `;
        return container;
    }

    show(notification) {
        const { message, type = 'info', duration = 5000 } = notification;
        const notifElement = document.createElement('div');
        notifElement.className = `notification notification-${type}`;
        notifElement.style.cssText = `
            padding: 15px 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-bottom: 10px;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 300px;
            max-width: 450px;
        `;

        // Appliquer les couleurs selon le type
        switch(type) {
            case 'success':
                notifElement.style.borderLeft = '4px solid #4CAF50';
                break;
            case 'error':
                notifElement.style.borderLeft = '4px solid #f44336';
                break;
            case 'warning':
                notifElement.style.borderLeft = '4px solid #ff9800';
                break;
            default:
                notifElement.style.borderLeft = '4px solid #2196F3';
        }

        // Contenu de la notification
        notifElement.innerHTML = `
            <div class="notification-content">
                <div class="notification-message">${message}</div>
            </div>
            <button class="notification-close" style="
                background: none;
                border: none;
                cursor: pointer;
                padding: 0 5px;
                font-size: 18px;
                opacity: 0.5;
            ">&times;</button>
        `;

        // Ajouter au container
        this.container.appendChild(notifElement);

        // Animation d'entrée
        setTimeout(() => {
            notifElement.style.transform = 'translateX(0)';
            notifElement.style.opacity = '1';
        }, 50);

        // Fermeture automatique
        const timeout = setTimeout(() => this.close(notifElement), duration);

        // Bouton de fermeture
        const closeBtn = notifElement.querySelector('.notification-close');
        closeBtn.addEventListener('click', () => {
            clearTimeout(timeout);
            this.close(notifElement);
        });

        // Pause au survol
        notifElement.addEventListener('mouseenter', () => clearTimeout(timeout));
        notifElement.addEventListener('mouseleave', () => {
            const timeout = setTimeout(() => this.close(notifElement), duration);
        });
    }

    close(element) {
        element.style.transform = 'translateX(100%)';
        element.style.opacity = '0';
        setTimeout(() => element.remove(), 300);
    }

    // Méthode pour vérifier les nouvelles notifications
    async checkNotifications() {
        try {
            const response = await fetch('?page=notifications/check', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const notifications = await response.json();
            notifications.forEach(notification => this.show(notification));
        } catch (error) {
            console.error('Erreur lors de la vérification des notifications:', error);
        }
    }
}

// Initialisation du gestionnaire de notifications
const notificationManager = new NotificationManager();

// Vérification périodique des notifications
setInterval(() => notificationManager.checkNotifications(), 10000);

// Styles CSS pour les notifications
const style = document.createElement('style');
style.textContent = `
    .notification {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size: 14px;
        line-height: 1.4;
    }

    .notification-message {
        margin-right: 15px;
    }

    .notification-close:hover {
        opacity: 0.8;
    }
`;
document.head.appendChild(style);