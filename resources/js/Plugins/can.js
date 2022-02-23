export default {
    install: (app) => {
        app.config.globalProperties.$can = (permission) => {
            return app.config.globalProperties.$page.props.auth.userPermissions.indexOf(permission) !== -1
        }

        app.provide('can')
    }
}