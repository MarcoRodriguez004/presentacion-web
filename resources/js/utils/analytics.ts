type AnalyticsProperties = Record<string, string | number | boolean>;

declare global {
    interface Window {
        plausible?: (
            eventName: string,
            options?: { props?: Record<string, string> },
        ) => void;
    }
}

export const trackEvent = (eventName: string, properties: AnalyticsProperties = {}) => {
    if (typeof window === 'undefined' || typeof window.plausible !== 'function') {
        return;
    }

    const props = Object.fromEntries(
        Object.entries(properties).map(([key, value]) => [key, String(value)]),
    );

    window.plausible(eventName, { props });
};
