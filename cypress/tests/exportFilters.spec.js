describe('Export Filters Test', () => {
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

    it('opens sidebar', () => {
        cy.get('.header-container42').click()
    })

    it('exports filters', () => {
        cy.get('.sidebar-location-input')
            .clear()
            .type('39.7370386,-8.7978764')
            .should('have.value', '39.7370386,-8.7978764')

        cy.get('.sidebar-range-input')
            .clear()
            .type('1000')
            .should('have.value', '1000')

        cy.get('.sidebar-button').contains('Export').click()
        cy.wait(500)
    })
})
