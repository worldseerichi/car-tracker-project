describe('Create Account Test', () => {
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

    it('visits account management page', () => {
        cy.get('.header-container5').click()

        cy.url()
            .should('include', '/manageAccounts')

        cy.wait(3000)
        cy.get('.vue-toastification__toast-body')
            .should('contain', 'Data loaded.')
    })

    it('creates an account', () => {
        cy.get('.g-p-s1-textinput')
            .type('createtest')
            .should('have.value', 'createtest')

        cy.get('.g-p-s1-textinput1')
            .type('createpass')
            .should('have.value', 'createpass')

        cy.get('.g-p-s1-button2').scrollIntoView().wait(2000).click() //wait for the scroll to finish before clicking

        cy.wait(3000)
        cy.get('.vue-toastification__toast-body')
            .should('contain', 'Account registered.')
    })
})
