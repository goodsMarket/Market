import React from 'react'
import styled, { css } from "styled-components";

function InsertBox({ children, ...props }) {
    const StyledBox = styled.div`
        border-radius: 19px;
        box-shadow: rgba(50, 50, 93, 0.2) 0px 3px 6px -1px,rgba(0, 0, 0, 0.2) 0px 1px 2px -1px;
        border: 1px solid #c1c1c1;
        max-width: 90%;
        width: 1100px;
        padding: 20px;
        margin: 0 auto;
    `;

    return <StyledBox {...props}>{children}</StyledBox>;
}

export default InsertBox;
