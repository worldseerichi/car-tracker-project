describe('Login Test', () => {
    beforeEach(() => {
        Cypress.Cookies.preserveOnce('laravel_session', 'XSRF-TOKEN')
    })

    it('attempts to visit tracking page', () => {
        cy.visit("/")

        cy.contains('Start Tracking').click()

        cy.url()
            .should('include', '/login')
    })

    it('logs in', () => {
        cy.get('.login-textinput')
            .type('root')
            .should('have.value', 'root')

        cy.get('.login-textinput1')
            .type('root')
            .should('have.value', 'root')

        cy.get('.login-button').click()

        cy.wait(3000)
        cy.get('.vue-toastification__toast-body')
            /*.invoke('text')
            .then((text)=>{
                const toastText = text
                expect(toastText).to.equal("Login successful.") //this method doesnt wait for the toast to change text
            })*/
            .should('contain', 'Login successful.')

        cy.url()
            .should('include', '/')
    })
})
