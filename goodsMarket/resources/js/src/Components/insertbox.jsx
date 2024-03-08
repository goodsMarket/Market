import React from 'react'
import styled, { css } from "styled-components";

function InsertBox({ children, ...props }) {
    const StyledBox = styled.div`
        border-radius: 24px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        max-width: 90%;
        width: 1100px;
        padding: 20px;
    `;

    return <StyledBox {...props}>{children}</StyledBox>;
}

export default InsertBox;
