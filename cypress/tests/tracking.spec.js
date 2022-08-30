describe('View Tracking Page Test', () => {
    beforeEach(() => {
        Cypress.Cookies.preserveOnce('laravel_session', 'XSRF-TOKEN')
    })

    it('logs in', () => {
        cy.visit("/")

        cy.get('.header-container7').click()

        cy.url()
            .should('include', '/login')

        cy.get('.login-textinput')
            .type('root')
            .should('have.value', 'root')

        cy.get('.login-textinput1')
            .type('root')
            .should('have.value', 'root')

        cy.get('.login-button').click()

        cy.wait(3000)
        cy.get('.vue-toastification__toast-body')
            .should('contain', 'Login successful.')

        cy.url()
            .should('include', '/')
    })

    it('visits tracking page', () => {
        cy.contains('Start Tracking').click()

        cy.url()
            .should('include', '/gps')

        cy.wait(3000)
        cy.get('.vue-toastification__toast-body')
            .should('contain', 'Data loaded.')
    })
})
